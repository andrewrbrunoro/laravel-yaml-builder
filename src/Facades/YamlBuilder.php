<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class YamlBuilder extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'yaml-builder';
    }

}
