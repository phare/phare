<?php

namespace Phare\Rules;

use Phare\File\File;
use Phare\Issue\Issue;
use Phare\Scope\Scope;

class FileExtension extends FilterRule
{
    private array $extensions;

    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    private function message(): string
    {
        return 'File extension must be one of: ' . implode(', ', $this->extensions);
    }

    private function fileHasCompliantExtension(File $file): bool
    {
        return in_array($file->getExtension(), $this->extensions, true);
    }

    public function handle(Scope $scope): void
    {
        foreach ($scope->getFileCollection() as $file) {
            if ($this->fileHasCompliantExtension($file)) {
                continue;
            }

            $scope->addIssue(
                new Issue($file, $this, $this->message())
            );

            $file->setFiltered();
        }
    }
}
