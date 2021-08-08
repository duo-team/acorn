<?php

namespace DuoTeam\Acorn\Support\DataProvider;

use Webmozart\Assert\Assert;

class MediaDataProvider
{
    /**
     * @param int $imageId
     * @return string
     */
    public function getAttachmentUrl(int $imageId): string
    {
        $attachmentUrl = wp_get_attachment_url($imageId);
        Assert::string($attachmentUrl);

        return $attachmentUrl;
    }
}