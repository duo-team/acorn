<?php

namespace DuoTeam\Acorn\Support\Posts;

use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use DuoTeam\Acorn\Enums\Post\Support\PostCoreFeaturesEnum;
use Illuminate\Contracts\Support\Arrayable;
use WP_REST_Posts_Controller as RestPostsController;

abstract class PostTypeArgs implements Arrayable
{
    protected static $MENU_POSITION = 99;
    protected static $MENU_ICON = 'dashicons-welcome-write-blog';

    /**
     * Get custom post type.
     *
     * @return PostTypeEnum
     */
    abstract public function getPostType(): PostTypeEnum;

    /**
     * Name of the post type shown in the menu.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return 'Frameworks';
    }

    /**
     * An array of labels for this post type.
     * If not set, post labels are inherited for
     * non-hierarchical types and page labels for hierarchical ones.
     *
     * @return array
     */
    public function getLabels(): array
    {
        return [];
    }

    /**
     * A short descriptive summary of what the post type is.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * Whether a post type is intended for use publicly either
     * via the admin interface or by front-end users
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * Whether the post type is hierarchical (e.g. page)
     *
     * @return bool
     */
    public function isHierarchical(): bool
    {
        return false;
    }

    /**
     * Whether to exclude posts with this post type from front end search results
     *
     * @return bool
     */
    public function isExcludedFromSearch(): bool
    {
        return !$this->isPublic();
    }

    /**
     * Whether queries can be performed on the front end
     * for the post type as part of parse_request()
     *
     * @return bool
     */
    public function isPubliclyQueryable(): bool
    {
        return $this->isPublic();
    }

    /**
     * Whether to generate and allow a UI for managing this post type in the admin.
     *
     * @return bool
     */
    public function isManageable(): bool
    {
        return true;
    }

    /**
     * Where to show the post type in the admin menu.
     *
     * @return bool
     */
    public function isVisibleInAdmin(): bool
    {
        return $this->isManageable();
    }

    /**
     * Makes this post type available for selection in navigation menus
     *
     * @return bool
     */
    public function isVisibleInNavMenus(): bool
    {
        return $this->isPublic();
    }

    /**
     * Makes this post type available via the admin bar.
     *
     * @return bool
     */
    public function isVisibleInAdminBar(): bool
    {
        return $this->isVisibleInAdmin();
    }

    /**
     *  Whether to include the post type in the REST API.
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
        return $this->getPostType();
    }

    /**
     * REST API Controller class name.
     *
     * @return string
     */
    public function getRestControllerClass(): string
    {
        return RestPostsController::class;
    }

    /**
     * The position in the menu order the post type should appear.
     *
     * @return int
     */
    public function getMenuPosition(): int
    {
        return static::$MENU_POSITION;
    }

    /**
     * The url to the icon to be used for this menu.
     *
     * @return string
     */
    public function getMenuIcon(): string
    {
        return static::$MENU_ICON;
    }

    /**
     * The string to use to build the read, edit, and delete capabilities
     *
     * @return string[]
     */
    public function getCapabilityType(): array
    {
        return ['post', 'posts'];
    }

    /**
     * Array of capabilities for this post type
     *
     * @return array
     */
    public function getCapabilities(): array
    {
        return [];
    }

    /**
     * Whether to use the internal default meta capability handling
     *
     * @return bool
     */
    public function shouldMapMetaCapabilities(): bool
    {
        return false;
    }

    /**
     * Core feature(s) the post type supports.
     *
     * @return array
     */
    public function supports(): array
    {
        return [
            PostCoreFeaturesEnum::TITLE(),
            PostCoreFeaturesEnum::EDITOR()
        ];
    }

    /**
     * An array of taxonomy identifiers that will be registered for the post type
     *
     * @return array
     */
    public function getSupportedTaxonomies(): array
    {
        return [];
    }

    /**
     * Whether there should be post type archives,
     * or if a string, the archive slug to use
     *
     * @return false|string
     */
    public function hasArchive()
    {
        return false;
    }

    /**
     * Triggers the handling of rewrites for this post type.
     *
     * @return array
     */
    public function getRewrites(): array
    {
        return [];
    }

    /**
     * Sets the query_var key for this post type.
     *
     * @return string|false
     */
    public function getQueryVar()
    {
        return $this->getPostType();
    }

    /**
     * Whether to allow this post type to be exported
     *
     * @return bool
     */
    public function canBeExported(): bool
    {
        return true;
    }

    /**
     * Whether to delete posts of this type when deleting a user.
     *
     * @return bool
     */
    public function shouldBeDeletedWithUser(): bool
    {
        return true;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'label' => $this->getLabel(),
            'labels' => $this->getLabels(),
            'description' => $this->getDescription(),
            'public' => $this->isPublic(),
            'hierarchical' => $this->isHierarchical(),
            'exclude_from_search' => $this->isExcludedFromSearch(),
            'publicly_queryable' => $this->isPubliclyQueryable(),
            'show_ui' => $this->isManageable(),
            'show_in_menu' => $this->isVisibleInAdmin(),
            'show_in_nav_menus' => $this->isVisibleInNavMenus(),
            'show_in_admin_bar' => $this->isVisibleInAdminBar(),
            'show_in_rest' => $this->isVisibleInRest(),
            'rest_base' => $this->getRestBase(),
            'rest_controller_class' => $this->getRestControllerClass(),
            'menu_position' => $this->getMenuPosition(),
            'menu_icon' => $this->getMenuIcon(),
            'capability_type' => $this->getCapabilityType(),
            'capabilities' => $this->getCapabilities(),
            'map_meta_cap' => $this->shouldMapMetaCapabilities(),
            'supports' => $this->supports(),
            'taxonomies' => $this->getSupportedTaxonomies(),
            'has_archive' => $this->hasArchive(),
            'rewrite' => $this->getRewrites(),
            'query_var' => $this->getQueryVar(),
            'can_export' => $this->canBeExported(),
            'delete_with_user' => $this->shouldBeDeletedWithUser(),
        ];
    }
}