<?php

namespace Phare\Tests\Rule;

use Phare\Exception\RuleArgumentException;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\FixIssues;
use Phare\Tests\Traits\TestFiles;

final class FileExtensionTest extends TestCase
{
    use FixIssues;
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
            [true, ['php'], 'StubTest.php'],
            [true, ['php', 'js'], 'StubTest.php'],
            [false, ['js'], 'StubTest.php'],
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

    public function test_it_is_not_fixable(): void
    {
        self::assertFalse((new FileExtension(['']))->fixable());
    }

    public function test_it_throw_exception_if_fix_called_with_wrong_arguments(): void
    {
        $this->assertRuleFixThrowException(new FileExtension(['']));
    }
}
