<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Request
{

    use Repository;

    private $schema;

    private $table;

    private $stubName = 'request.stub';

    public function __construct(Table $table, Schema $schema)
    {
        $this->table = $table;
        $this->schema = $schema;
    }

    public function getRequestName()
    {
        return $this->table->getStudlySingularName() . 'Request';
    }

    public function getStubName()
    {
        return $this->stubName;
    }

    public function getRules() : string
    {
        $rules = [];

        foreach ($this->schema->getFields() as $field) {
            $rules[] = sprintf("%s' => '%s", $field->getName(), implode('|', $field->getValidator()));
        }

        return $this->quickImplode($rules);
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'requestName' => $this->getRequestName(),
            'rules' => $this->getRules()
        ]);
    }

}
