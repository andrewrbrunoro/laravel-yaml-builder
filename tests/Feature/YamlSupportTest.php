<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Tests\Feature;

use AndrewRBrunoro\LaravelYamlBuilder\Facades\YamlBuilder;
use Orchestra\Testbench\TestCase;

class YamlSupportTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'AndrewRBrunoro\LaravelYamlBuilder\LaravelYamlBuilderServiceProvider',
        ];
    }

    /** @test */
    public function yaml_deploy()
    {
        YamlBuilder::setPath('schemas')
            ->sync('users.yaml');
    }
}
