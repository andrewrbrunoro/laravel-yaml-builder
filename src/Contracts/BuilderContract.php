<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Contracts;

use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Schema;

interface BuilderContract
{

    public function __construct(Schema $schema);

    public function output() : string;

}
