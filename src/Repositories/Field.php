<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Field
{
    private $field;

    public function __construct(array $field_attributes)
    {
        $this->field = $field_attributes;
    }

    public function isPrimaryKey()
    {
        return isset($this->field['primaryKey']);
    }

    public function getName()
    {
        return $this->field['field'];
    }

    public function getMigration()
    {
        return $this->field['migration'];
    }

    public function getValidator() : array
    {
        return !isset($this->field['validator']) ? [] : $this->field['validator'];
    }
}
