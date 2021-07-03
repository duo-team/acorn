<?php


namespace DuoTeam\Acorn\Filters\Theme\Acf;

use DuoTeam\Acorn\Support\Filter;

class AddOptions extends Filter
{
    /**
     * Register ACF options pages.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->getOptionsConfigurations() as $configuration) {
            $this->registerOptionsPage($configuration);
        }
    }


    /**
     * Gte options pages configurations.
     *
     * @return array
     */
    protected function getOptionsConfigurations(): array
    {
        return config('acf.options', []);
    }


    /**
     * Register options page with passed configuration.
     *
     * @param array $configuration
     *
     * @return void
     */
    protected function registerOptionsPage(array $configuration): void
    {
        acf_add_options_page($configuration);
    }
}
