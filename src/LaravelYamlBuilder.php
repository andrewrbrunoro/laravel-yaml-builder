<?php
namespace AndrewRBrunoro\LaravelYamlBuilder;

use AndrewRBrunoro\LaravelYamlBuilder\Support\Yaml;
use Exception;
use Illuminate\Support\Facades\File;

class LaravelYamlBuilder
{

    private $schemaName;

    private $path = "schemas";

    private const TYPES = [
        'yaml'
    ];

    /**
     * @param string $schema_name
     * @throws Exception
     */
    public function sync(
        string $schema_name
    ) : void
    {
        $this->setSchemaName($schema_name);

        switch (File::extension($schema_name)) {
            case "yaml":
                new Yaml($this);
                break;
            default:
                throw new Exception(sprintf("Unexpected EXTENSION: %s", $this->getSchemaName()));
        }
    }

    /**
     * @param string $schema_name
     * @return $this
     */
    public function setSchemaName(string $schema_name) : self
    {
        if ($this->extensionValidate($schema_name)) {
            $this->schemaName = $schema_name;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSchemaName() : string
    {
        return $this->schemaName;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path) : self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * {ROOT}/{$this->path}/*.yaml
     *
     * @return string
     * @throws Exception
     */
    public function getSchemaFullPath() : string
    {
        if (!$this->schemaName) {
            throw new Exception(sprintf("Schema not found in %s", $this->getPath() . DIRECTORY_SEPARATOR . $this->schemaName));
        } else {
            return $this->getPath() . DIRECTORY_SEPARATOR . $this->schemaName;
        }
    }

    /**
     * @return string
     */
    public function getAvailableExtensions() : string
    {
        return implode(',', self::TYPES);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function schemaFileExists() : bool
    {
        return file_exists($this->getSchemaFullPath());
    }

    /**
     * @param string $schema_name
     * @return bool
     */
    public function extensionValidate(string $schema_name) : bool
    {
        return in_array(File::extension($schema_name), self::TYPES);
    }

}
