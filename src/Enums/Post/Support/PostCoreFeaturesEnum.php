<?php

namespace DuoTeam\Acorn\Enums\Post\Support;

use MyCLabs\Enum\Enum;

/**
 * @method static PostCoreFeaturesEnum TITLE()
 * @method static PostCoreFeaturesEnum EDITOR()
 * @method static PostCoreFeaturesEnum COMMENTS()
 * @method static PostCoreFeaturesEnum REVISIONS()
 * @method static PostCoreFeaturesEnum TRACKBACKS()
 * @method static PostCoreFeaturesEnum AUTHOR()
 * @method static PostCoreFeaturesEnum EXCERPT()
 * @method static PostCoreFeaturesEnum PAGE_ATTRIBUTES()
 * @method static PostCoreFeaturesEnum THUMBNAIL()
 * @method static PostCoreFeaturesEnum CUSTOM_FIELDS()
 * @method static PostCoreFeaturesEnum POST_FORMATS()
 */
class PostCoreFeaturesEnum extends Enum
{
    protected const TITLE = 'title';
    protected const EDITOR = 'editor';
    protected const COMMENTS = 'comments';
    protected const REVISIONS = 'revisions';
    protected const TRACKBACKS = 'trackbacks';
    protected const AUTHOR = 'author';
    protected const EXCERPT = 'excerpt';
    protected const PAGE_ATTRIBUTES = 'page-attributes';
    protected const THUMBNAIL = 'thumbnail';
    protected const CUSTOM_FIELDS = 'custom-fields';
    protected const POST_FORMATS = 'post-formats';
}