<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Exception;

class Schema
{
    private $schema;

    private $fields = [];

    private $hidden = [];

    private $casts = [];

    public function __construct(array $schema)
    {
        $this->schema = $schema;

        $this->prepare();
    }

    private function prepare() : void
    {
        $this->readSchema();
        $this->readCasts();

        if (!$this->hasPrimaryKey()) {
            throw new Exception(__("Necessário informar um campo de primary key"));
        }
    }

    private function readSchema()
    {
        foreach ($this->schema as $item) {
            $this->setFields($item);
        }
    }

    public function hasPrimaryKey() : bool
    {
        foreach ($this->getFields() as $field) {
            if ($field->isPrimaryKey()) {
                return true;
            }
        }
        return false;
    }

    public function readCasts()
    {
        foreach ($this->casts as $item) {
            $this->setCast($item);
        }
    }

    public function setFields(array $field_attributes): void
    {
        if (isset($field_attributes['migration']))
            $field_attributes['migration'] = new Migration($field_attributes['migration']);

        $this->fields[] = new Field($field_attributes);
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setCast(array $item) : void
    {
        $this->casts[] = $item;
    }

    public function getCasts()
    {
        return $this->casts;
    }

}
