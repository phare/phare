<?php

namespace Phare\Tests\Rule;

use Phare\Preset\Regex;
use Phare\Rule\FileRegex;
use Phare\Tests\Traits\FixIssues;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class FileRegexTest extends TestCase
{
    use FixIssues;
    use TestFiles;

    public function test_it_get_correct_class(): void
    {
        self::assertEquals('FileRegex', (new FileRegex(''))->class());
    }

    public function test_it_has_error_message(): void
    {
        self::assertNotEmpty((new FileRegex(Regex::PASCAL_CASE))->errorMessage());
    }

    public function test_it_assert(): void
    {
        $tests = [
            [true, Regex::PASCAL_CASE, 'StubClass.php'],
            [true, Regex::CAMEL_CASE, 'stubClass.php'],
            [true, Regex::SNAKE_CASE, 'stub_class.php'],
            [false, Regex::PASCAL_CASE, 'stub.php'],
            [false, Regex::CAMEL_CASE, 'Stub.php'],
            [false, Regex::SNAKE_CASE, 'stubClass.php'],
        ];

        foreach ($tests as $test) {
            self::assertEquals(
                $test[0],
                (new FileRegex($test[1]))->assert(
                    $this->stubFile($test[2])
                )
            );
        }
    }

    public function test_it_is_fixable(): void
    {
        self::assertTrue((new FileRegex(Regex::PASCAL_CASE))->fixable());
    }

    public function test_it_is_not_fixable(): void
    {
        self::assertFalse((new FileRegex('/^[a-z]*$/'))->fixable());
    }

    public function test_it_fix_file(): void
    {
        $tests = [
            Regex::PASCAL_CASE => 'StubTest.php',
            Regex::CAMEL_CASE => 'stubTest.php',
            Regex::SNAKE_CASE => 'stub_test.php',
        ];

        foreach ($tests as $regex => $test) {
            $file = $this->stubFile('stub-test.php');
            $rename = $this->stubFile($test)->getRealPath();

            $fixer = $this->mockFileFixer(function (MockObject $mock) use ($file, $rename) {
                $mock->expects($this->once())
                    ->method('rename')
                    ->with($file, $rename);
            });

            (new FileRegex($regex))->fix($fixer, $file);
        }
    }

    public function test_it_does_not_fix_file(): void
    {
        $fixer = $this->mockFixer(function (MockObject $mock) {
            $mock->expects($this->never())
                ->method('file');
        });

        (new FileRegex('/^[a-z]*$/'))->fix($fixer, $this->stubFile('stub-test.php'));
    }
}
