<?php

namespace YourName\Modulizer;

use Illuminate\Support\ServiceProvider;
use YourName\Modulizer\Commands\MakeModuleCommand;

class ModulizerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/modulizer.php', 'modulizer');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/modulizer.php' => config_path('modulizer.php'),
            ], 'modulizer-config');

            $this->commands([
                MakeModuleCommand::class,
            ]);
        }
    }
}
