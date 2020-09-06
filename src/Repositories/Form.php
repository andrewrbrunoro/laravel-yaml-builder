<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Form
{

    use Repository;

    private $schema;

    private $form = [];

    const FILENAME = 'form.blade.php';

    public function __construct(Schema $schema)
    {
        $this->schema = $schema;

        $this->prepare();
    }

    public function getStubName() : string
    {
        return config('laravel-yaml-builder.theme') .
            DIRECTORY_SEPARATOR .
            'form.stub';
    }

    public function prepare() : void
    {
        foreach ($this->schema->getFields() as $field) {
            if ($field->isHidden()) continue;

            $this->form[] = $field->getHtmlElement();
        }
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'form' => $this->quickImplodeHtml($this->form)
        ]);
    }

}
