<?php

namespace Phare\File;

use Phare\Kernel;
use SplFileInfo;

class File
{
    private SplFileInfo $file;

    public function __construct(string $fileName)
    {
        $this->file = new SplFileInfo($fileName);
    }

    public function getFilenameWithoutExtension(): string
    {
        $filename = $this->file->getFilename();

        return pathinfo($filename, \PATHINFO_FILENAME);
    }

    public function replace(string $fileName): void
    {
        $this->file = new SplFileInfo($fileName);
    }

    public function getPath(): string
    {
        return $this->file->getPath();
    }

    public function getRealPath(): string
    {
        return $this->file->getRealPath();
    }

    public function getExtension(): string
    {
        return $this->file->getExtension();
    }

    public function getWorkingPath(): string
    {
        return str_replace(Kernel::getProjectRoot(), '', $this->getRealPath());
    }
}
