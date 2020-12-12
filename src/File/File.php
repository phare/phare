<?php

namespace Phare\File;

use Phare\Issue\Issue;
use Phare\Issue\IssueCollection;
use Symfony\Component\Finder\SplFileInfo;

class File
{
    private SplFileInfo $file;

    private bool $filtered = false;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
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
}
