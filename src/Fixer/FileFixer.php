<?php

namespace Phare\Fixer;

use Phare\File\File;
use Symfony\Component\Filesystem\Filesystem;

class FileFixer
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function rename(File $file, string $fileName): void
    {
        $this->filesystem->rename($file->getRealPath(), $fileName);

        $file->replace($fileName);
    }
}
