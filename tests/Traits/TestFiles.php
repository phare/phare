<?php

namespace Phare\Tests\Traits;

use Phare\File\File;

trait TestFiles
{
    public function stub(string $fileName): string
    {
        return str_replace('/Traits', '/stubs', __DIR__) . '/' . $fileName;
    }

    public function stubFile(string $fileName): File
    {
        return new File($this->stub($fileName));
    }
}
