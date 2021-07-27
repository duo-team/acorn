<?php

namespace DuoTeam\Acorn\Enums\Taxonomy;

use MyCLabs\Enum\Enum;

/**
 * @method static TaxonomyEnum CATEGORY()
 * @method static TaxonomyEnum POST_TAG()
 * @method static TaxonomyEnum NAV_MENU()
 * @method static TaxonomyEnum LINK_CATEGORY()
 * @method static TaxonomyEnum POST_FORMAT()
 */
class TaxonomyEnum extends Enum
{
    protected const CATEGORY = 'category';
    protected const POST_TAG = 'post_tag';
    protected const NAV_MENU = 'nav_menu';
    protected const LINK_CATEGORY = 'link_category';
    protected const POST_FORMAT = 'post_format';
}