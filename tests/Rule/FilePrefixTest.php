<?php

namespace Phare\Tests\Rule;

use Phare\Exception\RuleArgumentException;
use Phare\Preset\Regex;
use Phare\Rule\FilePrefix;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\FixIssues;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\MockObject\MockObject;

final class FilePrefixTest extends TestCase
{
    use FixIssues;
    use TestFiles;

    public function test_it_has_error_message(): void
    {
        self::assertNotEmpty((new FilePrefix('Prefix'))->errorMessage());
    }

    public function test_it_assert(): void
    {
        $tests = [
            [true, 'Stub', 'StubTest.php'],
            [true, 'StubTest', 'StubTest.php'],
            [true, '', 'StubTest.php'],
            [false, 'stub', 'StubTest.php'],
            [false, 'Test', 'StubTest.php'],
            [false, 'php', 'StubTest.php'],
        ];

        foreach ($tests as $test) {
            self::assertEquals(
                $test[0],
                (new FilePrefix($test[1]))->assert(
                    $this->stubFile($test[2])
                )
            );
        }
    }

    public function test_it_is_fixable(): void
    {
        self::assertTrue((new FilePrefix('Prefix'))->fixable());
    }

    public function test_it_fix_file(): void
    {
        $tests = [
            'Foo' => 'FooStubTest.php',
        ];

        foreach ($tests as $prefix => $result) {
            $file = $this->stubFile('StubTest.php');
            $rename = $file->getPath() . DIRECTORY_SEPARATOR . $result;

            $fixer = $this->mockFileFixer(function (MockObject $mock) use ($file, $rename) {
                $mock->expects($this->once())
                    ->method('rename')
                    ->with($file, $rename);
            });

            (new FilePrefix($prefix))->fix($fixer, $file);
        }
    }
}
