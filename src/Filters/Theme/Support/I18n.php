<?php

namespace DuoTeam\Acorn\Filters\Theme\Support;

use DuoTeam\Acorn\Support\Filter;

class I18n extends Filter
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
     * Load text domain for theme.
     *
     * @return void
     */
    public function handle(): void
    {
        load_theme_textdomain(
            get_theme_text_domain(),
            resource_path('lang/wordpress')
        );
    }
}
