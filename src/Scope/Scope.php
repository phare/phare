<?php

namespace NicolasBeauvais\Warden\Scope;

class Scope
{
    protected array $paths;

    protected array $excludes;

    protected array $rules;

    public function __construct(array $paths = [], array $excludes = [], array $rules = [])
    {
        $this->paths = $paths;
        $this->excludes = $excludes;
        $this->rules = $rules;
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
}
