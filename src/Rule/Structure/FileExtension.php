<?php

namespace NicolasBeauvais\Warden\Rule\Structure;

use NicolasBeauvais\Warden\File\File;
use NicolasBeauvais\Warden\Issue\Issue;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Rule\Rule;
use NicolasBeauvais\Warden\Scope\Scope;

class FileExtension extends Rule
{
    public string $type = self::TYPE_FILTER;

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

            $file->addIssue(
                new Issue($this, $scope, $this->message())
            );

            $file->setFiltered();
        }
    }
}
