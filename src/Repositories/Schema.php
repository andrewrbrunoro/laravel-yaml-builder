<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Schema
{
    private $schema;

    private $fields = [];

    public function __construct(array $schema)
    {
        $this->schema = $schema;

        $this->prepare();
    }

    private function prepare()
    {
        foreach ($this->schema as $item) {
            $this->setFields($item);
        }
    }

    public function setFields(array $field_attributes): void
    {
        $this->fields[] = new Field($field_attributes);
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
