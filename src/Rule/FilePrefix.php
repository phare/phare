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
        return "File must use prefix $this->prefix";
    }

    public function assert(File $file): bool
    {
        return str_starts_with($file->getFilenameWithoutExtension(), $this->prefix);
    }

    public function fixable(): bool
    {
        return true;
    }

    public function fix(Fixer $fixer, File $file): void
    {
        $fileName = $file->getFilenameWithoutExtension();

        $fileName = $this->prefix . $fileName;

        $fixer->file()->rename(
            $file,
            $file->getPath() . "/$fileName." . $file->getExtension()
        );
    }
}
