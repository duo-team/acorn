<?php


namespace DuoTeam\Acorn\Enums\Post;

use MyCLabs\Enum\Enum;

/**
 * @method static PostPingStatusEnum OPEN()
 * @method static PostPingStatusEnum CLOSED()
 */
class PostPingStatusEnum extends Enum
{
    protected const OPEN = 'open';
    protected const CLOSED = 'closed';
}