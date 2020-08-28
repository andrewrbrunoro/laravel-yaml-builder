<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Support;

use AndrewRBrunoro\LaravelYamlBuilder\Contracts\Signature;
use AndrewRBrunoro\LaravelYamlBuilder\LaravelYamlBuilder;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Controller;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Index;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Model;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Request;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Route;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Schema;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\Table;
use AndrewRBrunoro\LaravelYamlBuilder\Repositories\View;
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

            $table  = new Table($yaml_parse['table']);
            $schema = new Schema($yaml_parse['schema']);

            if (isset($yaml_parse['hidden'])) {
                foreach ($yaml_parse['hidden'] as $item) {
                    $schema->setHidden($item);
                }
            }

            $route   = new Route($table);

            $request    = new Request($table, $schema);
            $model      = new Model($table, $schema);
            $controller = new Controller($model, $route);

            if (isset($yaml_parse['views'])) {
                foreach ($yaml_parse['views'] as $view) {
                    switch ($view['view']) {
                        case 'index':
                            $index = new Index(new View($view));
                            break;
                        default:
                            break;
                    }
                }
            }



//            dump($request->make());
//            dump($model->make());
//            dump($controller->make());
            dump($index->make());
            exit;
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
