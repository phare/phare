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

    private function fileHasCompliantExtension(File $file): bool
    {
        return in_array($file->getExtension(), $this->extensions, true);
    }

    public function assert(File $file): bool
    {
        return $this->fileHasCompliantExtension($file);
    }

    public function fixable(): bool
    {
        return true;
        // TODO: Implement fixable() method.
    }

    public function fix(): void
    {
        // TODO: Implement fix() method.
    }
}
