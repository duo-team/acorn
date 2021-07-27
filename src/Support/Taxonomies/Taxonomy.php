<?php

namespace DuoTeam\Acorn\Support\Taxonomies;

use DuoTeam\Acorn\Enums\Post\PostTypeEnum;
use DuoTeam\Acorn\Enums\Taxonomy\TaxonomyEnum;
use DuoTeam\Acorn\Support\Taxonomies\Exceptions\RegisterTaxonomyException;
use Throwable;
use Webmozart\Assert\Assert;

abstract class Taxonomy
{
    /**
     * Taxonomy args instance.
     *
     * @var TaxonomyArgs
     */
    protected $args;

    /**
     * @param TaxonomyArgs $args
     */
    public function __construct(TaxonomyArgs $args)
    {
        $this->args = $args;
    }

    /**
     * Get taxonomy key.
     *
     * @return TaxonomyEnum
     */
    abstract public function getTaxonomy(): TaxonomyEnum;

    /**
     * Get supported post types.
     *
     * @return array<PostTypeEnum>
     */
    public function supports(): array
    {
        return [];
    }

    /**
     * Get taxonomy args.
     *
     * @return TaxonomyArgs
     */
    public function getArgs(): TaxonomyArgs
    {
        return $this->args;
    }

    /**
     * Register taxonomy in system.
     *
     * @return void
     * @throws Throwable
     */
    public function register(): void
    {
        $this->assertSupportedPostTypesIsValid();
        $result = register_taxonomy($this->getTaxonomy(), $this->supports(), $this->getArgs()->toArray());

        if (is_wp_error($result)) {
            throw RegisterTaxonomyException::fromWordPressError($result);
        }
    }

    /**
     * Assert is everything fine with supported post types.
     *
     * @return void
     */
    protected function assertSupportedPostTypesIsValid(): void
    {
        Assert::notEmpty($this->supports());
        Assert::allIsInstanceOf($this->supports(), PostTypeEnum::class);
    }
}