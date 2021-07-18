<?php


namespace DuoTeam\Acorn\Enums\Post;

use MyCLabs\Enum\Enum;

/**
 * @method static PostPingStatus OPEN()
 * @method static PostPingStatus CLOSED()
 */
class PostPingStatus extends Enum
{
    protected const OPEN = 'open';
    protected const CLOSED = 'closed';
}