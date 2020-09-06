<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Field
{
    private $field;

    public function __construct(array $field_attributes)
    {
        $this->field = $field_attributes;
    }

    public function isRequired() : bool
    {
        return !isset($this->field['required'])
            ? true
            : $this->field['required'];
    }

    public function isPrimaryKey() : bool
    {
        return $this->getMigration()->isPrimaryKey();
    }

    public function isHidden() : bool
    {
        return isset($this->field['hidden']);
    }

    public function getHtmlElement() : string
    {
        switch ($this->getMigration()->getType()) {
            case 'primaryKey':
                return "";
            case 'varchar':
            default:
                return (new Input($this))->make();
        }
    }

    public function getName() : string
    {
        return $this->field['field'];
    }

    public function getMigration() : Migration
    {
        return $this->field['migration'];
    }

    public function getValidator() : Validator
    {
        return new Validator(isset($this->field['validator']) ? $this->field['validator'] : []);
    }

    public function getTitle()
    {
        return !isset($this->field['title']) ? $this->getName() : $this->field['title'];
    }
}
