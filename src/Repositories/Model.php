<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Model
{

    use Repository;

    private $schema;

    private $stubName = 'model.stub';

    private $table;

    public function __construct(Table $table, Schema $schema)
    {
        $this->table = $table;
        $this->schema = $schema;
    }

    public function getFields()
    {
        return $this->schema->getFields();
    }

    public function setStubName(string $stub_name) : void
    {
        $this->stubName = $stub_name;
    }

    public function getModelName()
    {
        return $this->table->getStudlySingularName();
    }

    public function getStubName()
    {
        return $this->stubName;
    }

    public function getFillable(): string
    {
        $fillable = [];

        foreach ($this->schema->getFields() as $field) {
            $fillable[] = $field->getName();
        }

        return $this->quickImplode($fillable);
    }

    public function getCasts() : string
    {
        $casts = [];

        foreach ($this->schema->getCasts() as $cast) {
            $casts[] = $cast;
        }

        return $this->quickImplode($casts);
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'model' => $this->table->getStudlySingularName(),
            'fillable' => $this->getFillable(),
            'hidden' => "",
            'casts' => $this->getCasts()
        ]);
    }

}
