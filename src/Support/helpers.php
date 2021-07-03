<?php

if (!function_exists('get_theme_text_domain')) {
    /**
     * Get theme text domain.
     *
     * @param string $default
     *
     * @return string
     */
    function get_theme_text_domain(string $default = 'duo-team'): string
    {
        $theme = wp_get_theme();
        $textDomain = $theme->get('TextDomain');

        if (!is_string($textDomain)) {
            return $default;
        }

        return $textDomain;
    }
}
