<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;


class Index
{

    use Repository;

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function getStubName()
    {
        return 'views/' . config('laravel-yaml-builder.theme') . '/index.stub';
    }

    public function getThead() : string
    {
        $thead = [];

        foreach ($this->view->getThead() as $key) {
            $thead[] = "<th>{{__('". $key ."')}}</th>";
        }

        return $this->quickImplodeHtml($thead);
    }

    public function getTbody() : string
    {
        $tbody = [];

        foreach ($this->view->getTbody() as $key) {
            $tbody[] = '<td>{{ ' . $key . ' }}</td>';
        }

        return $this->quickImplodeHtml($tbody);
    }

    public function make() : string
    {
        $stub = $this->getStubFile($this->getStubName());

        return str_var_replace($stub, [
            'title' => $this->view->getTitle(),
            'thead' => $this->getThead(),
            'tbody' => $this->getTbody()
        ]);
    }

}
