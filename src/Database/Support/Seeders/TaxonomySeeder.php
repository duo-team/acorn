<?php

namespace DuoTeam\Acorn\Database\Support\Seeders;

use DuoTeam\Acorn\Database\Repositories\Taxonomy\TermTaxonomyRepository;
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
     * @param TermTaxonomyRepository $termsTaxonomies
     */
    public function __construct(TermTaxonomyRepository $termsTaxonomies)
    {
        $this->termsTaxonomies = $termsTaxonomies;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
