<?php

namespace Phare\Tests\Rule;

use Phare\Exception\RuleArgumentException;
use Phare\Rule\FileExtension;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\TestCase;

final class FileExtensionTest extends TestCase
{
    use TestFiles;

    public function test_it_has_error_message(): void
    {
        self::assertNotEmpty((new FileExtension(['php', 'js']))->errorMessage());
    }

    public function test_it_throws_exception_if_wrong_arguments(): void
    {
        $this->expectException(RuleArgumentException::class);

        new FileExtension([]);
    }

    public function test_it_assert(): void
    {
        $tests = [
            [true, ['php'], 'stub.php'],
            [true, ['php', 'js'], 'stub.php'],
            [false, ['php'], 'stub.js'],
        ];

        foreach ($tests as $test) {
            self::assertEquals(
                $test[0],
                (new FileExtension($test[1]))->assert(
                    $this->stubFile($test[2])
                )
            );
        }
    }

    public function test_it_isnt_fixable(): void
    {
        self::assertFalse((new FileExtension(['']))->fixable());
    }
}
