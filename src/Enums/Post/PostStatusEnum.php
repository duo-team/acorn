<?php

namespace DuoTeam\Acorn\Enums\Post;

use MyCLabs\Enum\Enum;

/**
 * @method static PostStatusEnum PUBLISH()
 * @method static PostStatusEnum FUTURE()
 * @method static PostStatusEnum DRAFT()
 * @method static PostStatusEnum PENDING()
 * @method static PostStatusEnum PRIVATE()
 * @method static PostStatusEnum TRASH()
 * @method static PostStatusEnum AUTO_DRAFT()
 * @method static PostStatusEnum INHERIT()
 */
class PostStatusEnum extends Enum
{
    protected const PUBLISH = 'publish';
    protected const FUTURE = 'future';
    protected const DRAFT = 'draft';
    protected const PENDING = 'pending';
    protected const PRIVATE = 'private';
    protected const TRASH = 'trash';
    protected const AUTO_DRAFT = 'auto-draft';
    protected const INHERIT = 'inherit';
}