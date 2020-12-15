<?php


namespace Phare\File;

use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

class Filesystem
{
    private SymfonyFilesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new SymfonyFilesystem();
    }

    public static function rename(File $file, $fileName)
    {
        (new SymfonyFilesystem())->rename($file->getRealPath(), $fileName);

        $file->replace($fileName);
    }
}
