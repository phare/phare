<?php

namespace Phare\Scope;

use JetBrains\PhpStorm\Pure;
use Phare\Rule\Rule;
use Symfony\Component\Finder\Finder;

class Scope
{
    private string $name;

    protected array $paths;

    protected array $excludes;

    protected array $rules;

    protected Finder $finder;

    #[Pure]
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

    public function getExcludes(): array
    {
        return $this->excludes;
    }

    /**
     * @return Rule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function setFinder(Finder $finder): Scope
    {
        $this->finder = $finder;

        return $this;
    }

    public function getFinder(): Finder
    {
        return $this->finder;
    }
}
