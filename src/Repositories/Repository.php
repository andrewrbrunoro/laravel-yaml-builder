<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;


use Illuminate\Support\Facades\File;

trait Repository
{

    public function quickImplode (array $attributes = []) : string
    {
        return "'" . implode("','", $attributes) . "'";
    }

    public function quickImplodeHtml(array $attributes = []) : string
    {
        return implode("\n", $attributes) ;
    }

    public function getStubFile(string $stubName) : string
    {
        return File::get(
            dirname(dirname(__FILE__)) .
            DIRECTORY_SEPARATOR .
            'stubs' .
            DIRECTORY_SEPARATOR .
            $stubName
        );
    }

}
