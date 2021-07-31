<?php

namespace DuoTeam\Acorn\Services\Media;

use DuoTeam\Acorn\Services\Media\Enums\AttachmentType;
use DuoTeam\Acorn\Services\Media\Enums\DownloadReturnType;
use DuoTeam\Acorn\Services\Media\Exceptions\AttachmentDownloadException;
use Illuminate\Cache\Repository as Cache;
use RuntimeException;

class AttachmentDownloader
{
    /**
     * Image url to download.
     *
     * @var string
     */
    protected $imageUrl = 'https://picsum.photos/%s/%s.jpg';

    /**
     * Attachment cache key.
     *
     * @var string
     */
    protected $cacheKey = 'attachment_t:%s';

    /**
     * Cache repository instance.
     *
     * @var Cache
     */
    protected $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Download image from web.
     *
     * @param int $width
     * @param int $height
     * @param bool $useCache
     * @return int
     * @throws \Throwable
     */
    public function downloadImage(int $width = 1024, int $height = 768, bool $useCache = true): int
    {
        $cacheKey = $this->composeCacheKey(AttachmentType::IMAGE(), sprintf('w:%s_h:%s', $width, $height));

        if ($useCache && $this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $imageUrl = sprintf($this->imageUrl, $width, $height);
        $attachmentId = $this->downloadAttachment($imageUrl);

        if ($useCache) {
            $this->cache->put($cacheKey, $attachmentId);
        }

        return $attachmentId;
    }

    /**
     * Compose cache key by for attachment.
     *
     * @param string $attachmentType
     * @param string $suffix
     *
     * @return string
     */
    protected function composeCacheKey(string $attachmentType, string $suffix = ''): string
    {
        return implode('_', array_filter([
            sprintf($this->cacheKey, $attachmentType),
            $suffix
        ]));
    }

    /**
     * @param string $attachmentUrl
     * @param int $postId
     * @param string $description
     *
     * @return int
     * @throws \Throwable
     */
    protected function downloadAttachment(string $attachmentUrl, int $postId = 0, string $description = ''): int
    {
        $attachmentId = media_sideload_image($attachmentUrl, $postId, $description, DownloadReturnType::ID()->getValue());

        if (is_wp_error($attachmentId)) {
            throw AttachmentDownloadException::fromWordPressError($attachmentId);
        }

        return (int) $attachmentId;
    }
}
