<?php

namespace DuoTeam\Acorn\Support\DataProvider;

use Webmozart\Assert\Assert;

class MediaDataProvider
{
    /**
     * @param int $attachmentId
     * @return string
     */
    public function getAttachmentUrl(int $attachmentId): string
    {
        $attachmentUrl = wp_get_attachment_url($attachmentId);
        Assert::string($attachmentUrl);

        return $attachmentUrl;
    }
}