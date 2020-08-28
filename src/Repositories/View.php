<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

class View
{

    private $attributes;

    private $varName = '$data';

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function getVarName()
    {
        return $this->varName;
    }

    public function getTitle() : string
    {
        return isset($this->attributes['title']) 
            ? $this->attributes['title'] 
            : "";
    }

    public function getThead() : array
    {
        return isset($this->attributes['thead']) && is_array($this->attributes['thead']) 
            ? $this->attributes['thead'] 
            : [];
    }

    public function getTbody() : array
    {
        if ($this->getThead()) {
            $tbody = [];
            foreach ($this->getThead() as $item) {
                $tbody[] = $this->getVarName() . '->' . $item;
            }
            return $tbody;
        }
        return [];
    }
}
