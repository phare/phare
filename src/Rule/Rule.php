<?php

namespace NicolasBeauvais\Warden\Rule;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Scope\Scope;

abstract class Rule
{
    public const TYPE_FILTER = 'filter';

    public const TYPE_LINTER = 'linter';

    private FileCollection $files;

    public string $type = self::TYPE_FILTER;

    abstract public function handle(Scope $scope): void;

    public function isType(string $type): bool
    {
        return $this->type === $type;
    }
}
