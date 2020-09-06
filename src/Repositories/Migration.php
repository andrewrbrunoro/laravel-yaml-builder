<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class Migration
{

    private $migration;

    public function __construct(array $migration)
    {
        $this->migration = $migration;
    }

    public function getType() : string
    {
        if ($this->isPrimaryKey())
            return "primaryKey";

        if (!isset($this->migration['type']))
            return "text";

        switch ($this->migration['type']) {
            case "varchar":
            default:
                return "text";
        }
    }

    public function getLimit() : string
    {
        return isset($this->migration['limit']) ? $this->migration['limit'] : '';
    }

    public function getPrimaryKey() : bool
    {
        return isset($this->migration['primaryKey']);
    }

    public function isPrimaryKey() : bool
    {
        return $this->getPrimaryKey();
    }
}
