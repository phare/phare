<?php

namespace NicolasBeauvais\Warden\Scope;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Rule\Rule;

class Scope
{
    private string $name;

    protected array $paths;

    protected array $excludes;

    protected array $rules;

    protected FileCollection $fileCollection;

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

    public function getRules(string $type = null): array
    {
        if (!$type) {
            return $this->rules;
        }

        return array_filter($this->rules, static function (Rule $rule) use ($type) {
            return $rule->isType($type);
        });
    }

    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }

    public function getFileCollection(): FileCollection
    {
        return $this->fileCollection;
    }

    public function setFileCollection(FileCollection $fileCollection): void
    {
        $this->fileCollection = $fileCollection;
    }
}
