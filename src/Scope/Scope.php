<?php

namespace NicolasBeauvais\Warden\Scope;

class Scope
{
    private string $name;

    protected array $paths;

    protected array $excludes;

    protected array $rules;

    private array $files;

    public function __construct(string $name, array $paths = ['*'], array $excludes = [], array $rules = [])
    {
        $this->name = $name;
        $this->paths = $paths;
        $this->excludes = $excludes;
        $this->rules = $rules;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPaths(): array
    {
        return $this->paths;
    }

    public function setPaths(array $paths): void
    {
        $this->paths = $paths;
    }

    public function getExcludes(): array
    {
        return $this->excludes;
    }

    public function setExcludes(array $excludes): void
    {
        $this->excludes = $excludes;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function pushFile(string $file): void
    {
        if (!in_array($file, $this->files, true)) {
            $this->files[] = $file;
        }
    }
}
