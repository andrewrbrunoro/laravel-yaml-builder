<?php
namespace AndrewRBrunoro\LaravelYamlBuilder\Repositories;

use Illuminate\Support\Facades\File;

class Write
{

    private $path;
    private $repository;
    private $file;

    public function __construct($repository, string $path, string $file)
    {
        if (!method_exists($repository, 'make')) {
            throw new \Exception('Falha ao criar');
        }

        $this->repository = $repository;
        $this->path = $path;
        $this->file = $file;

        $this->setupDir();
        $this->deploy();
    }

    public function getFilename()
    {
        return $this->path . '/' . $this->file;
    }

    public function fileExists() : bool
    {
        return file_exists($this->path . '/' . $this->file);
    }

    public function dirExists() : bool
    {
        return is_dir($this->path);
    }

    public function setupDir() : void
    {
        if (!$this->dirExists()) {
            File::makeDirectory($this->path, 0755, true);
        }
    }

    public function deploy() : void
    {
        if (!$this->fileExists()) {
            File::put($this->getFilename(), $this->repository->make());
        } else {
            throw new \Exception(sprintf('O arquivo %s já existe', $this->file));
        }
    }
}
