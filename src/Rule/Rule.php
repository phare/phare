<?php

namespace Phare\Rule;

use Phare\File\File;
use ReflectionClass;

abstract class Rule
{
    protected bool $failed = false;

    abstract public function assert(File $file): bool;

    abstract public function errorMessage(): string;

    abstract public function fixable(): bool;

    abstract public function fix(File $file): void;

    public function class(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }
}
