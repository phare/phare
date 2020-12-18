<?php

namespace Phare\Fixer;

use Symfony\Component\Filesystem\Filesystem;

class Fixer
{
    public function file(): FileFixer
    {
        return new FileFixer(new Filesystem());
    }
}
