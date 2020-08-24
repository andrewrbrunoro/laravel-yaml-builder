<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Field
{
    private $field;

    public function __construct(array $field_attributes)
    {
        $this->field = $field_attributes;
    }

    public function getName()
    {
        return $this->field['name'];
    }

    public function getMigration()
    {
        return $this->field['migration'];
    }

    public function getValidator()
    {
        return $this->field['validator'];
    }
}
