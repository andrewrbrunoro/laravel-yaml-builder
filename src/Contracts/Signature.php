<?php

namespace AndrewRBrunoro\LaravelYamlBuilder\Contracts;

use AndrewRBrunoro\LaravelYamlBuilder\LaravelYamlBuilder;

interface Signature
{
    public function __construct(LaravelYamlBuilder $file);

    public function deploy();
}
