<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Edit
{

    use Repository;

    private $route;

    private $view;

    const FILENAME = 'edit.blade.php';

    public function __construct(Route $route, View $view)
    {
        $this->route = $route;
        $this->view  = $view;
    }

    public function getStubName() : string
    {
        return config('laravel-yaml-builder.theme') .
            DIRECTORY_SEPARATOR .
            'edit.stub';
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'title' => $this->view->getTitle(),
            'route' => $this->route->getRouteName()
        ]);
    }

}
