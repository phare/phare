<?php

namespace Phare\Tests\Traits;

use Exception;
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

    public function createStubFile(string $filename): void
    {
        file_put_contents($this->stub($filename), '');
    }

    public function deleteStubFile(string $filename): void
    {
        try {
            unlink($this->stub($filename));
        } catch (Exception $exception) {
        }
    }
}
