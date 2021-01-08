<?php

namespace Phare\Tests\Rule;

use Phare\Exception\RuleIsNotFixable;
use Phare\Rule\DirectoryDepth;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\FixIssues;
use Phare\Tests\Traits\TestFiles;

final class DirectoryDepthTest extends TestCase
{
    use TestFiles;
    use FixIssues;

    public function test_it_has_error_message(): void
    {
        self::assertStringContainsString('between', (new DirectoryDepth(0, 3))->errorMessage());
        self::assertStringContainsString('greater than', (new DirectoryDepth())->errorMessage());
    }

    public function test_it_assert(): void
    {
        $tests = [
            [true, [], 'StubTest.php'],
            [true, [0], 'StubTest.php'],
            [true, [0,10], 'StubTest.php'],
            [true, [null,10], 'StubTest.php'],
            [false, [null,0], 'StubTest.php'],
            [false, [4], 'StubTest.php'],
            [true, [null,6], 'sub/sub/sub/sub/StubTest.php'],
            [false, [null,3], 'sub/sub/sub/sub/StubTest.php'],
        ];

        foreach ($tests as $test) {
            self::assertEquals(
                $test[0],
                (new DirectoryDepth(...$test[1]))->assert(
                    $this->stubFile($test[2])
                )
            );
        }
    }

    public function test_it_is_not_fixable(): void
    {
        self::assertFalse((new DirectoryDepth())->fixable());
    }

    public function test_it_throw_exception_if_fix_called(): void
    {
        $this->assertRuleFixThrowException(new DirectoryDepth());
    }
}
