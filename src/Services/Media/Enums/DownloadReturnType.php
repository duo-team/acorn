<?php

namespace DuoTeam\Acorn\Services\Media\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static DownloadReturnType HTML()
 * @method static DownloadReturnType URL()
 * @method static DownloadReturnType ID()
 */
class DownloadReturnType extends Enum
{
    protected const HTML = 'html';
    protected const URL = 'src';
    protected const ID = 'id';
}
