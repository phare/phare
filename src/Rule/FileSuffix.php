<?php

namespace Phare\Rule;

use Phare\File\File;
use Phare\Fixer\Fixer;

class FileSuffix extends Rule
{
    private string $suffix;

    public function __construct(string $suffix)
    {
        $this->suffix = $suffix;
    }

    public function errorMessage(): string
    {
        return "File must use suffix $this->suffix";
    }

    public function assert(File $file): bool
    {
        return str_ends_with($file->getFilenameWithoutExtension(), $this->suffix);
    }

    public function fixable(): bool
    {
        return true;
    }

    public function fix(Fixer $fixer, File $file): void
    {
        $fileName = $file->getFilenameWithoutExtension();

        $fileName .= $this->suffix;

        $fixer->file()->rename(
            $file,
            $file->getPath() . "/$fileName." . $file->getExtension()
        );
    }
}
