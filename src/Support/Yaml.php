<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Support;

use AndrewRBrunoro\LaravelYamlBuilder\Contracts\Signature;
use AndrewRBrunoro\LaravelYamlBuilder\LaravelYamlBuilder;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Schema;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Table;
use Illuminate\Support\Facades\Validator;

class Yaml implements Signature
{
    private $laravelYamlBuilder;

    public function __construct(LaravelYamlBuilder $laravelYamlBuilder)
    {
        $this->laravelYamlBuilder = $laravelYamlBuilder;

        $this->deploy();
    }

    public function deploy()
    {
        $this->parse(yaml_parse_file($this->laravelYamlBuilder->getSchemaFullPath()));
    }

    public function parse(array $yaml_parse)
    {
        if ($this->validateParse($yaml_parse)) {

            $table = new Table($yaml_parse['table']);
            $schema = new Schema($yaml_parse['schema']);

            dd($schema->getFields());
        } else {
            dd('error');
        }
    }

    public function validateParse(array $parse): bool
    {
        $validator = Validator::make($parse, [
            'table' => 'required',
            'schema' => 'required|array',
        ]);

        return ! $validator->fails();
    }
}
