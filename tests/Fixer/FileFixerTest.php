<?php

namespace Phare\Tests\Fixer;

use Phare\File\File;
use Phare\Fixer\FileFixer;
use Phare\Fixer\Fixer;
use Phare\Kernel;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class FileFixerTest extends TestCase
{
    use TestFiles;

    public function fileFixer(): FileFixer
    {
        return Kernel::container()->get(FileFixer::class);
    }

    public function test_it_rename_a_file(): void
    {
        $this->fileFixer()->rename($this->stubFile('StubTest.php'), $this->stub('StubTestRenamed.php'));

        self::assertFileExists($this->stub('StubTestRenamed.php'));
        self::assertFileDoesNotExist($this->stub('StubTest.php'));

        $this->fileFixer()->rename($this->stubFile('StubTestRenamed.php'), $this->stub('StubTest.php'));

        self::assertFileExists($this->stub('StubTest.php'));
        self::assertFileDoesNotExist($this->stub('StubTestRenamed.php'));
    }
}
