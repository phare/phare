<?php

namespace Phare\Rule;

use Phare\File\File;

abstract class Rule
{
    protected bool $failed = false;

    abstract public function assert(File $file): bool;

    abstract public function fixable(): bool;

    abstract public function fix(): void;
}
