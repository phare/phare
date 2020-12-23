<?php

namespace Phare\Rule;

use Phare\File\File;

class FileIsPlural extends Rule
{
    public function __construct()
    {
    }

    public function errorMessage(): string
    {
        return 'error';
    }

    public function assert(File $file): bool
    {
        return false;
    }

    public function fixable(): bool
    {
        return false;
    }

    public function fix(\Phare\Fixer\Fixer $fixer, File $file): void
    {
        // TODO: Implement fix() method.
    }
}
