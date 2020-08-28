<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Builders;

use AndrewRBrunoro\LaravelYamlBuilder\Contracts\BuilderContract;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Schema;

class Builder implements BuilderContract
{

    private $schema;

    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    public function output(): string
    {

    }

    private function fillable()
    {

    }

    private function hidden()
    {

    }

    public function casts()
    {

    }
}
