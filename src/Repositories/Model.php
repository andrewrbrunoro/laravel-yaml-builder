<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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

    public function getHidden()
    {
        $hidden = [];

        foreach ($this->schema->getHidden() as $field) {
            $hidden[] = $field;
        }

        return $this->quickImplode($hidden);
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
            'hidden' => $this->getHidden(),
            'casts' => $this->getCasts()
        ]);
    }

}
