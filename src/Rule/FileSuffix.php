<?php

namespace Phare\Rule;

use Phare\File\File;
use Phare\Fixer\Fixer;

class FileSuffix extends Rule
{
    public function __construct(string $suffix)
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

    public function fix(Fixer $fixer, File $file): void
    {
        // TODO: Implement fix() method.
    }
}
