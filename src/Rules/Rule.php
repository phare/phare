<?php

namespace Phare\Rules;

use Phare\File\FileCollection;
use Phare\Scope\Scope;

abstract class Rule
{
    public const TYPE_FILTER = 'filter';

    public const TYPE_LINTER = 'linter';

    private FileCollection $files;

    protected string $type = self::TYPE_FILTER;

    abstract public function handle(Scope $scope): void;

    public function isType(string $type): bool
    {
        return $this->type === $type;
    }
}
