<?php

namespace DuoTeam\Acorn\Services\Media\Exceptions;

use DuoTeam\Acorn\Exceptions\Support\HasWordPressErrorFactoryMethods;
use RuntimeException;

class AttachmentDownloadException extends RuntimeException
{
    use HasWordPressErrorFactoryMethods;
}
