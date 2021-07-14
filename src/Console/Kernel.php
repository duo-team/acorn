<?php

namespace DuoTeam\Acorn\Console;

use Illuminate\Console\Application;
use Illuminate\Console\Scheduling\Schedule;
use Roots\Acorn\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Get roots commands to register.
     *
     * @return array
     */
    protected function rootsCommands(): array
    {
        return array_filter([
            'Roots\Acorn\Console\Commands\ComposerMakeCommand',
            'Roots\Acorn\Console\Commands\ConfigCacheCommand',
            'Roots\Acorn\Console\Commands\ConfigClearCommand',
            'Roots\Acorn\Console\Commands\ConsoleMakeCommand',
            'Roots\Acorn\Console\Commands\ComponentMakeCommand',
            'Roots\Acorn\Console\Commands\OptimizeClearCommand',
            'Roots\Acorn\Console\Commands\OptimizeCommand',
            'Roots\Acorn\Console\Commands\PackageClearCommand',
            'Roots\Acorn\Console\Commands\PackageDiscoverCommand',
            'Roots\Acorn\Console\Commands\ProviderMakeCommand',
            'Roots\Acorn\Console\Commands\SummaryCommand',
            'Roots\Acorn\Console\Commands\VendorPublishCommand',
            'Roots\Acorn\Console\Commands\ViewCacheCommand',
            'Roots\Acorn\Console\Commands\ViewClearCommand',
        ], 'class_exists');
    }

    /**
     * Get illuminate commands to register.
     *
     * @return array
     */
    protected function illuminateCommands(): array
    {
        return array_filter([
            'Illuminate\Database\Console\Migrations\FreshCommand',
            'Illuminate\Database\Console\Migrations\InstallCommand',
            'Illuminate\Database\Console\Migrations\MigrateCommand',
            'Illuminate\Database\Console\Migrations\MigrateMakeCommand',
            'Illuminate\Database\Console\Migrations\RefreshCommand',
            'Illuminate\Database\Console\Migrations\ResetCommand',
            'Illuminate\Database\Console\Migrations\RollbackCommand',
            'Illuminate\Database\Console\Migrations\StatusCommand',
        ], 'class_exists');
    }

    /**
     * Get the Console application instance.
     *
     * @return Application
     */
    protected function getConsole(): Application
    {
        return parent::getConsole()
            ->resolveCommands($this->rootsCommands())
            ->resolveCommands($this->illuminateCommands());
    }

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }

    /**
     * Register application commands.
     *
     * @return void
     */
    public function commands(): void
    {
        $this->load($this->app->path('Console/Commands'));
    }
}
