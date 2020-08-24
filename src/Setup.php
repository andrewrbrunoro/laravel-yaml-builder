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

    public function syncStubs()
    {

    }

    public function index()
    {

    }

}
