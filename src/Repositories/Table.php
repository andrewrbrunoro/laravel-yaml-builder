<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Table
{

    private $tableName;

    public function __construct(string $table_name)
    {
        $this->tableName = $table_name;
    }

    public function getTableName() : string
    {
        return $this->tableName;
    }

}
