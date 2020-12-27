<?php

namespace Phare\Tests\File;

use Phare\Exception\FileDoesNotExistException;
use Phare\File\File;
use Phare\Kernel;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;
use SplFileInfo;

class FileTest extends TestCase
{
    use TestFiles;

    public function test_it_get_filename_without_extension(): void
    {
        $file = __DIR__ . '/../stubs/StubTest.php';

        self::assertEquals('StubTest', (new File($file))->getFilenameWithoutExtension());
    }

    public function test_it_get_extension(): void
    {
        $file = __DIR__ . '/../stubs/StubTest.php';

        self::assertEquals((new SplFileInfo($file))->getExtension(), (new File($file))->getExtension());
    }

    public function test_it_get_path(): void
    {
         $file = __DIR__ . '/../stubs/StubTest.php';

        self::assertEquals((new SplFileInfo($file))->getPath(), (new File($file))->getPath());
    }

    public function test_it_get_working_path(): void
    {
         $file = __DIR__ . '/../stubs/StubTest.php';

        self::assertEquals(
            str_replace(Kernel::getProjectRoot(), '', (new SplFileInfo($file))->getRealPath()),
            (new File($file))->getWorkingPath()
        );
    }

    public function test_it_get_real_path(): void
    {
         $file = __DIR__ . '/../stubs/StubTest.php';

        self::assertEquals((new SplFileInfo($file))->getRealPath(), (new File($file))->getRealPath());
    }

    public function test_it_get_real_path_of_file_that_does_not_exist(): void
    {
         $file = __DIR__ . '/wrong';

         $this->expectException(FileDoesNotExistException::class);

         (new File($file))->getRealPath();
    }

    public function test_it_replace(): void
    {
        $file = new File(__DIR__ . '/../stubs/StubTest.php');

        $file->replace(__DIR__ . '/../stubs/stubTest.php');

        self::assertEquals(new File(__DIR__ . '/../stubs/stubTest.php'), $file);
    }
}
