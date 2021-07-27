<?php

namespace DuoTeam\Acorn\Support\Taxonomies;

use DuoTeam\Acorn\Enums\Taxonomy\TaxonomyEnum;
use Illuminate\Contracts\Support\Arrayable;
use WP_REST_Terms_Controller as RestTermsController;

abstract class TaxonomyArgs implements Arrayable
{
    /**
     * Get taxonomy key.
     *
     * @return TaxonomyEnum
     */
    abstract public function getTaxonomy(): TaxonomyEnum;

    /**
     * Get an array of labels for this taxonomy
     *
     * @return array
     */
    public function getLabels(): array
    {
        return [];
    }

    /**
     * A short descriptive summary of what the taxonomy is for.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * Whether a taxonomy is intended for use publicly either
     * via the admin interface or by front-end users.
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * Whether the taxonomy is publicly queryable.
     *
     * @return bool
     */
    public function isPubliclyQueryable(): bool
    {
        return $this->isPublic();
    }

    /**
     * Whether the taxonomy is hierarchical.
     *
     * @return bool
     */
    public function isHierarchical(): bool
    {
        return false;
    }

    /**
     * Whether to generate and allow a UI
     * for managing terms in this taxonomy in the admin.
     *
     * @return bool
     */
    public function isManageable(): bool
    {
        return true;
    }

    /**
     * Whether to show the taxonomy in the admin menu.
     *
     * @return bool
     */
    public function isVisibleInAdmin(): bool
    {
        return $this->isManageable();
    }

    /**
     * Get metabox callback.
     * Set to false to hide it.
     *
     * @return callable|false
     */
    public function getMetaBoxCallback()
    {
        return false;
    }

    /**
     * Makes this taxonomy available for selection in navigation menus.
     *
     * @return bool
     */
    public function isVisibleInNavMenus(): bool
    {
        return $this->isPublic();
    }

    /**
     *  Whether to include the taxonomy in the REST API.
     *
     * @return bool
     */
    public function isVisibleInRest(): bool
    {
        return false;
    }

    /**
     * To change the base url of REST API route.
     *
     * @return string
     */
    public function getRestBase(): string
    {
        return $this->getTaxonomy();
    }

    /**
     * REST API Controller class name.
     *
     * @return string
     */
    public function getRestControllerClass(): string
    {
        return RestTermsController::class;
    }

    /**
     * Whether to list the taxonomy in the Tag Cloud Widget controls.
     *
     * @return bool
     */
    public function hasTagCloud(): bool
    {
        return $this->isManageable();
    }

    /**
     * Whether to list the taxonomy in the Tag Cloud Widget controls.
     *
     * @return bool
     */
    public function shouldShowTagCloud(): bool
    {
        return $this->isManageable();
    }

    /**
     * Whether to show the taxonomy in the quick/bulk edit panel.
     *
     * @return bool
     */
    public function isVisibleInQuickEdit(): bool
    {
        return $this->isManageable();
    }

    /**
     * Whether to display a column for the taxonomy on its post type listing screens.
     *
     * @return bool
     */
    public function isVisibleInPostsListColumn(): bool
    {
        return false;
    }

    /**
     * Array of capabilities for this taxonomy.
     *
     * @return array
     */
    public function getCapabilities(): array
    {
        return [];
    }

    /**
     * Triggers the handling of rewrites for this taxonomy.
     *
     * @return array
     */
    public function getRewrites(): array
    {
        return [];
    }

    /**
     * Sets the query var key for this taxonomy.
     *
     * @return string
     */
    public function getQueryVar(): string
    {
        return $this->getTaxonomy();
    }

    /**
     * Default term to be used for the taxonomy.
     *
     * @return array
     */
    public function getDefaultTerm(): array
    {
        return [];
    }

    /**
     * Whether terms in this taxonomy should be sorted.
     *
     * @return bool
     */
    public function shouldBeSorted(): bool
    {
        return false;
    }

    /**
     * Array of arguments to automatically
     * use inside wp_get_object_terms() for this taxonomy.
     *
     * @return array
     * @see wp_get_object_terms()
     */
    public function getObjectTermsArgs(): array
    {
        return [];
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'labels' => $this->getLabels(),
            'description' => $this->getDescription(),
            'public' => $this->isPublic(),
            'publicly_queryable' => $this->isPubliclyQueryable(),
            'hierarchical' => $this->isHierarchical(),
            'show_ui' => $this->isManageable(),
            'show_in_menu' => $this->isVisibleInAdmin(),
            'meta_box_cb' => $this->getMetaBoxCallback(),
            'show_in_nav_menus' => $this->isVisibleInNavMenus(),
            'show_in_rest' => $this->isVisibleInRest(),
            'rest_base' => $this->getRestBase(),
            'rest_controller_class' => $this->getRestControllerClass(),
            'show_tagcloud' => $this->shouldShowTagCloud(),
            'show_in_quick_edit' => $this->isVisibleInQuickEdit(),
            'show_admin_column' => $this->isVisibleInPostsListColumn(),
            'capabilities' => $this->getCapabilities(),
            'rewrite' => $this->getRewrites(),
            'query_var' => $this->getQueryVar(),
            'default_term' => $this->getDefaultTerm(),
            'sort' => $this->shouldBeSorted(),
            'args' => $this->getObjectTermsArgs()
        ];
    }

}