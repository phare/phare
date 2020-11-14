<?php

namespace NicolasBeauvais\Warden\File;

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
}
