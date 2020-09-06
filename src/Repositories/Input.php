<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Input
{

    use Repository;

    private $field;

    public function __construct(Field $field)
    {
        $this->field = $field;
    }

    public function getStubName() : string
    {
        return config('laravel-yaml-builder.theme') .
            DIRECTORY_SEPARATOR .
            'form/input.stub';
    }

    public function getName() : string
    {
        return $this->field->getName();
    }

    public function getType() : string
    {
        return $this->field->getMigration()->getType();
    }

    public function getTitle()
    {
        return $this->field->getTitle();
    }

    public function getRequiredLabel()
    {
        return $this->field->getValidator();
    }

    public function getRequired() : bool
    {
        return $this->field->getValidator()->isRequired();
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'name'  => $this->getName(),
            'id'    => $this->getName(),
            'dusk'  => $this->getName(),
            'type'  => $this->getType(),
            'title' => $this->getTitle(),
            'required' => $this->getRequired() ? 'required' : ''
        ]);
    }

}
