<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Create
{

    use Repository;

    private $route;

    private $view;

    const FILENAME = 'create.blade.php';

    public function __construct(Route $route, View $view)
    {
        $this->route = $route;
        $this->view  = $view;
    }

    public function getStubName() : string
    {
        return config('laravel-yaml-builder.theme') .
            DIRECTORY_SEPARATOR .
            'create.stub';
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'title' => $this->view->getTitle(),
            'route' => $this->route->getCreateRoute(),
            'route_to_view' => $this->route->getRouteName()
        ]);
    }

}
