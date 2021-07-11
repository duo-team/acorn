<?php

namespace DuoTeam\Acorn\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static PostTypeEnum POST()
 * @method static PostTypeEnum PAGE()
 * @method static PostTypeEnum ATTACHMENT()
 * @method static PostTypeEnum REVISION()
 * @method static PostTypeEnum NAV_MENU_ITEM()
 */
class PostTypeEnum extends Enum
{
    protected const POST = 'post';
    protected const PAGE = 'page';
    protected const ATTACHMENT = 'attachment';
    protected const REVISION = 'revision';
    protected const NAV_MENU_ITEM = 'nav_menu_item';
}