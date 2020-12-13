<?php

namespace Phare\Rule;

use Phare\File\File;

class FileExtension extends Rule
{
    private array $extensions;

    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    public function errorMessage(): string
    {
        return 'Extension should be one of: ' . implode(', ', $this->extensions);
    }

    public function assert(File $file): bool
    {
        return in_array($file->getExtension(), $this->extensions, true);
    }

    public function fixable(): bool
    {
        return false;
    }

    public function fix(File $file): void {}
}
