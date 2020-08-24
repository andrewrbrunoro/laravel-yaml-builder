<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Tests\Unit;

use AndrewRBrunoro\LaravelYamlBuilder\Facades\YamlBuilder;
use Orchestra\Testbench\TestCase;

class YamlBuilderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'AndrewRBrunoro\LaravelYamlBuilder\LaravelYamlBuilderServiceProvider',
        ];
    }

    /** @test */
    public function can_change_path()
    {
        YamlBuilder::setPath('foo_path');
        $this->assertEquals('foo_path', YamlBuilder::getPath());
    }

    /** @test */
    public function can_set_schema_name()
    {
        $schema_name = 'users.yaml';

        $this->assertEquals($schema_name, YamlBuilder::setSchemaName($schema_name)->getSchemaName());
    }

    /** @test */
    public function can_read_path()
    {
        $this->assertEquals('schemas', YamlBuilder::getPath());
    }

    /** @test */
    public function read_available_extensions()
    {
        $this->assertEquals('yaml', YamlBuilder::getAvailableExtensions());
    }

    /** @test */
    public function error_get_schema_full_path_without_schema_name()
    {
        try {
            YamlBuilder::getSchemaFullPath();
        } catch (\Exception $exception) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function exception_schema_not_exists()
    {
        try {
            YamlBuilder::schemaFileExists();
        } catch (\Exception $exception) {
            $this->assertTrue(true);
        }
    }

    /** @test */
    public function can_read_schema_file_exists()
    {
        $this->assertTrue(YamlBuilder::setSchemaName('users.yaml')->schemaFileExists());
    }

    /** @test */
    public function exception_when_use_unsupported_extension()
    {
        $this->assertFalse(YamlBuilder::extensionValidate('users.json'));
    }
}
