<?php

namespace DuoTeam\Acorn\Filters\Theme\Support\Features;

use DuoTeam\Acorn\Support\Filter;

class Soil extends Filter
{
    /**
     * Google Analytics code.
     *
     * @var string|null
     */
    protected $googleAnalyticsCode = null;

    /**
     * The filter tag it responds to.
     *
     * @var string
     */
    protected $tag = [
        'after_setup_theme'
    ];

    /**
     * Enable support for Sage Soil.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->baseSupport();

        if (!get_current_user_id()) {
            $this->guestSupport();
        }
    }

    /**
     * Add Base Soil support.
     *
     * @return void
     */
    private function baseSupport(): void
    {
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-js-to-footer');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');

        if (!empty($this->googleAnalyticsCode)) {
            add_theme_support('soil-google-analytics', $this->googleAnalyticsCode);
        }
    }

    /**
     * Add Soil support for guest users.
     *
     * @return void
     */
    private function guestSupport(): void
    {
        add_theme_support('soil-disable-rest-api');
        add_theme_support('soil-disable-trackbacks');
    }
}
