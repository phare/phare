<?php

namespace Phare\Rule;

use Phare\File\File;
use Phare\Fixer\Fixer;

class FilePrefix extends Rule
{
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
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
