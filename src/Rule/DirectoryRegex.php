<?php

namespace Phare\Rule;

use Phare\File\File;

class DirectoryRegex extends Rule
{
    public function __construct(string $regex)
    {
    }

    public function errorMessage(): string
    {
        // TODO: Implement errorMessage() method.
    }

    public function assert(File $file): bool
    {
        // TODO: Implement assert() method.
    }

    public function fixable(): bool
    {
        // TODO: Implement fixable() method.
    }

    public function fix(\Phare\Fixer\Fixer $fixer, File $file): void
    {
        // TODO: Implement fix() method.
    }
}
