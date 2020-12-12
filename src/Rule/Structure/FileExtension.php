<?php

namespace Phare\Rule\Structure;

use Phare\File\File;
use Phare\Issue\Issue;
use Phare\Issue\IssueCollection;
use Phare\Rule\Rule;
use Phare\Scope\Scope;

class FileExtension extends Rule
{
    protected string $type = self::TYPE_FILTER;

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
