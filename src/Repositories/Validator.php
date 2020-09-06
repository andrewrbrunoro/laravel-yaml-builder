<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Collection;

class Validator
{

    protected $validator;

    public function __construct(array $validator)
    {
        $this->validator = $this->configure($validator);
    }

    public function configure(array $validator) : Collection
    {
        return collect($validator);
    }

    public function isRequired() : bool
    {
        return $this->validator->search('required') !== false;
    }

}
