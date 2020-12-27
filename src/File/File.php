<?php

namespace Phare\File;

use Phare\Exception\FileDoesNotExistException;
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

    public function getExtension(): string
    {
        return $this->file->getExtension();
    }

    public function getPath(): string
    {
        return $this->file->getPath();
    }

    public function getWorkingPath(): string
    {
        return str_replace(Kernel::getProjectRoot(), '', $this->getRealPath());
    }

    /**
     * @throws FileDoesNotExistException
     */
    public function getRealPath(): string
    {
        $realPath = $this->file->getRealPath();

        if (!$realPath) {
            throw new FileDoesNotExistException('File does not exist: ' . $this->getPath());
        }

        return $realPath;
    }

    public function replace(string $fileName): void
    {
        $this->file = new SplFileInfo($fileName);
    }
}
