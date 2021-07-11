<?php


namespace DuoTeam\Acorn\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static PostCommentStatusEnum OPEN()
 * @method static PostCommentStatusEnum CLOSED()
 */
class PostCommentStatusEnum extends Enum
{
    protected const OPEN = 'open';
    protected const CLOSED = 'closed';
}