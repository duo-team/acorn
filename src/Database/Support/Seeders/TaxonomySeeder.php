<?php

namespace DuoTeam\Acorn\Database\Support\Seeders;

use DuoTeam\Acorn\Database\Repositories\Taxonomy\TermTaxonomyRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Seeder;
use Webmozart\Assert\Assert;

abstract class TaxonomySeeder extends Seeder
{
    /**
     * Terms to create.
     *
     * @var array
     */
    protected $terms = [];

    /**
     * @var TermTaxonomyRepository
     */
    protected $termsTaxonomies;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function run()
    {
        $this->termsTaxonomies = $this->makeTermsTaxonomies();
        $this->createTerms();
    }

    /**
     * Create terms.
     *
     * @return void
     */
    protected function createTerms(): void
    {
        foreach ($this->terms as $term) {
            if ($this->termsTaxonomies->exists($term)) {
                continue;
            }

            $this->termsTaxonomies->create(
                $this->prepareTermToInsert($term)
            );
        }
    }

    /**
     * Prepare term attributes to insert into database.
     *
     * @param array|string $term
     * @return array
     */
    protected function prepareTermToInsert($term): array
    {
        if (is_array($term)) {
            Assert::keyExists($term, 'term');

            return $term;
        }

        return ['term' => $term];
    }

    /**
     * Get made term taxonomy repository instance.
     *
     * @return TermTaxonomyRepository
     * @throws BindingResolutionException
     */
    public function makeTermsTaxonomies(): TermTaxonomyRepository
    {
        $termTaxonomyRepository = $this->getTermTaxonomyRepository();
        Assert::isAOf($termTaxonomyRepository, TermTaxonomyRepository::class);

        return $this->container->make($termTaxonomyRepository);
    }

    /**
     * Get class for repository to use.
     *
     * @return string
     */
    public function getTermTaxonomyRepository(): string
    {
        return TermTaxonomyRepository::class;
    }
}
