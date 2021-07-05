<?php

use function Roots\resource_path;

return [
    /*
    |--------------------------------------------------------------------------
    | Advanced Custom Fields save and load path.
    |--------------------------------------------------------------------------
    | A path where ACF JSON will be saved and loaded.
    |
    */
    'path' => resource_path('acf'),

    /*
    |--------------------------------------------------------------------------
    | Advanced Custom Fields options pages.
    |--------------------------------------------------------------------------
    | This value is a path where acf json files will be saved
    |
    */
    'options' => [
        [
            'page_title' => __('Opcje globalne', 'duo-team'),
            'menu_title' => __('Opcje globalne', 'duo-team'),
            'menu_slug' => 'page-theme-general-options',
            'capability' => 'edit_posts',
            'redirect' => false
        ]
    ]
];
