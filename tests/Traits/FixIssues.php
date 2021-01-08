<?php

namespace Phare\Tests\Traits;

use Closure;
use Phare\Exception\RuleIsNotFixable;
use Phare\Fixer\FileFixer;
use Phare\Fixer\Fixer;
use Phare\Rule\Rule;
use PHPUnit\Framework\MockObject\MockObject;

trait FixIssues
{
    public function mockFixer(Closure $fixerClosure = null)
    {
        $fixerMock = $this->createMock(Fixer::class);

        if ($fixerClosure) {
            $fixerClosure($fixerMock);
        }

        return $fixerMock;
    }

    public function mockFileFixer(Closure $fileFixerClosure)
    {
        $fileFixerMock = $this->createMock(FileFixer::class);

        $fileFixerClosure($fileFixerMock);

        return $this->mockFixer(function (MockObject $mock) use ($fileFixerMock) {
            $mock->expects(self::once())
                ->method('file')
                ->willReturn($fileFixerMock);
        });
    }

    public function assertRuleFixThrowException(Rule $rule): void
    {
        $this->expectException(RuleIsNotFixable::class);

        $rule->fix($this->mockFixer(), $this->stubFile('StubTest.php'));
    }
}
