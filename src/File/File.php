<?php

namespace NicolasBeauvais\Warden\File;

use NicolasBeauvais\Warden\Issue\Issue;
use NicolasBeauvais\Warden\Issue\IssueCollection;
use Symfony\Component\Finder\SplFileInfo;

class File
{
    private SplFileInfo $file;

    private bool $filtered = false;

    private IssueCollection $issueCollection;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
        $this->issueCollection = new IssueCollection;
    }

    public function setFiltered(): void
    {
        $this->filtered = true;
    }

    public function isFiltered(): bool
    {
        return $this->filtered;
    }

    public function getRealPath(): string
    {
        return $this->file->getRealPath();
    }

    public function getExtension(): string
    {
        return $this->file->getExtension();
    }

    public function addIssue(Issue $issue): void
    {
        $this->issueCollection->add($issue);
    }

    public function hasIssues(): bool
    {
        return !$this->issueCollection->isEmpty();
    }

    public function getIssueCollection(): IssueCollection
    {
        return $this->issueCollection;
    }
}
