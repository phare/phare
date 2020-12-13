<?php

namespace Phare\File;

use Phare\Assertion\Assertion;
use Symfony\Component\Finder\SplFileInfo;

class File
{
    private SplFileInfo $file;

    public function __construct(SplFileInfo $file)
    {
        $this->file = $file;
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
