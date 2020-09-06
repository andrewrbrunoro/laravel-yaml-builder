<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Str;

class Route
{

    use Repository;

    private $table;

    public function __construct(Table $table)
    {
        $this->table = $table;
    }

    public function getStubName()
    {
        return 'route.stub';
    }

    public function getPathView() : string
    {
        return $this->getRouteName();
    }

    private function getBaseRoute(string $routeAction)
    {
        return Str::finish($this->getRouteName() . '.', $routeAction);
    }

    public function getRouteName()
    {
        return $this->table->getTableName();
    }

    public function getIndexRoute()
    {
        return $this->getBaseRoute('index');
    }

    public function getCreateRoute()
    {
        return $this->getBaseRoute('create');
    }

    public function getStoreRoute()
    {
        return $this->getBaseRoute('store');
    }

    public function getEditRoute()
    {
        return $this->getBaseRoute('edit');
    }

    public function getUpdateRoute()
    {
        return $this->getBaseRoute('update');
    }

    public function getDeleteRoute()
    {
        return $this->getBaseRoute('destroy');
    }

    public function getNameSpace()
    {
        return sprintf('App\Http\Controllers\%s', Str::ucfirst($this->getRouteName()));
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'route' => $this->getRouteName(),
            'namespace' => $this->getNameSpace()
        ]);
    }

}
