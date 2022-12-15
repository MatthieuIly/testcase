<?php

namespace Sankokai\Usecase;

use Illuminate\Support\ServiceProvider;
use Sankokai\Usecase\Console\UsecaseCommand;

class UsecaseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    public function register()
    {
        $this->commands([
            UsecaseCommand::class,
        ]);
    }

    private function registerPublishing()
    {
        // $this->publishes(__DIR__ . '');
    }
}
