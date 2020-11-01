<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Scope\Scope;

class Guideline
{
    protected array $scopes;

    public function __construct(array $scopes = [])
    {
        $this->scopes = $scopes;
    }

    public function addScope(string $name, Scope $scope): self
    {
        $this->scopes[$name] = $scope;

        return $this;
    }

    public function getScope(string $name): ?Scope
    {
        return $this->scopes[$name] ?? null;
    }
}
