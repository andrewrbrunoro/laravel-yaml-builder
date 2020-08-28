<?php
namespace AndrewRBrunoro\LaravelYamlBuilder;

use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Schema;

class Setup
{

    private $schema;

    public function __construct(Schema $schema)
    {
        $this->schema = $schema;

        $this->syncStubs();
    }

    private function syncStubs()
    {
        $this->model();
    }

    private function model() : string
    {
        $fillable = [];
        foreach ($this->schema->getFields() as $field) {
            $fillable[] = $field['name'];
        }

        $fillable = implode(',\n', $fillable);
    }

}
