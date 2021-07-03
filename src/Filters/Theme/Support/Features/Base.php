<?php

namespace DuoTeam\Acorn\Filters\Theme\Support\Features;

use DuoTeam\Acorn\Support\Filter;

class Base extends Filter
{
    /**
     * The filter tag it responds to.
     *
     * @var string
     */
    protected $tag = [
        'after_setup_theme'
    ];

    /**
     * Enable support for base theme feature.
     *
     * @return void
     */
    public function handle(): void
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
        add_theme_support('customize-selective-refresh-widgets');
    }
}
