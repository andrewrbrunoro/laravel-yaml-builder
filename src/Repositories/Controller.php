<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Controller
{

    use Repository;

    private $model;

    private $route;

    private $stubName = 'controller.stub';

    public function __construct(Model $model, Route $route)
    {
        $this->model = $model;
        $this->route = $route;

        $this->make();
    }

    public function getStubName() : string
    {
        return $this->stubName;
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'modelName' => $this->model->getModelName(),
            'pathToView' => $this->route->getPathView()
        ]);
    }

}
