<?php

namespace Phare\Fixer;

use Symfony\Component\Filesystem\Filesystem;

class Fixer
{
    public static function file(): FileFixer
    {
        return new FileFixer(new Filesystem());
    }
}
