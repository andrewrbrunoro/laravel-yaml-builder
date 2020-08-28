<?php

namespace AndrewRBrunoro\LaravelYamlBuilder;

use Illuminate\Support\ServiceProvider;

class LaravelYamlBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind('yaml-builder', function () {
            return new LaravelYamlBuilder();
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-yaml-builder.php', 'laravel-yaml-builder');
    }
}
