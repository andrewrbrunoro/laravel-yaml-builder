<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Str;

class Table
{
    private $tableName;

    public function __construct(string $table_name)
    {
        $this->tableName = $table_name;
    }

    public function getStudlySingularName()
    {
        return Str::studly(Str::singular($this->getTableName()));
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }
}
