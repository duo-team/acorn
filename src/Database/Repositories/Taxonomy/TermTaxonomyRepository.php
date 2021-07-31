<?php

namespace DuoTeam\Acorn\Database\Repositories\Taxonomy;

use DuoTeam\Acorn\Database\Exceptions\ModelInsertException;
use DuoTeam\Acorn\Database\Exceptions\ModelRetrieveException;
use DuoTeam\Acorn\Database\Models\Taxonomy\TermTaxonomy;
use DuoTeam\Acorn\Database\Support\Repositories\EloquentRepository;
use DuoTeam\Acorn\Enums\Taxonomy\TaxonomyEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use RuntimeException;
use Webmozart\Assert\Assert;

class TermTaxonomyRepository extends EloquentRepository
{
    /**
     * Create term from name.
     *
     * @param string $termName
     * @return Model
     */
    public function createFromName(string $termName): Model
    {
        return $this->create(['term' => $termName]);
    }

    /**
     * Create model.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        Assert::keyExists($attributes, 'term');
        $result = wp_insert_term(
            $attributes['term'],
            $this->getTaxonomy()->getValue(),
            $attributes
        );

        if (is_wp_error($result)) {
            throw ModelInsertException::fromWordPressError($result);
        }

        Assert::isArray($result);
        Assert::keyExists($result, 'term_taxonomy_id');

        return $this->get($result['term_taxonomy_id']);
    }

    /**
     * Check if resource exists.
     *
     * @param string $id
     *
     * @return bool
     */
    public function exists(string $id): bool
    {
        return !empty(term_exists($id, $this->getTaxonomy()->getValue()));
    }


    /**
     * Get eloquent builder.
     *
     * @return Builder
     */
    public function builder(): Builder
    {
        return TermTaxonomy::query();
    }

    /**
     * Find model by column or return null if model not found.
     *
     * @param string $column
     * @param string $value
     * @param array $columns
     *
     * @return Model
     */
    public function findByColumn(string $column, string $value, array $columns = ['*']): ?Model
    {
        $term = get_term_by($column, $value, $this->getTaxonomy()->getValue());

        if (is_wp_error($term)) {
            throw ModelRetrieveException::fromWordPressError($term);
        }

        if (!$term) {
            return null;
        }

        return $term;
    }

    /**
     * Get
     * @param string $name
     *
     * @return Model
     */
    public function getByName(string $name): Model
    {
        return $this->getByColumn('name', $name);
    }

    /**
     * Get taxonomy.
     *
     * @return TaxonomyEnum
     */
    protected function getTaxonomy(): TaxonomyEnum
    {
        return TaxonomyEnum::CATEGORY();
    }
}