<?php

namespace Phare\Tests\Traits;

use Closure;
use Phare\Fixer\FileFixer;
use Phare\Fixer\Fixer;
use PHPUnit\Framework\MockObject\MockObject;

trait FixIssues
{
    public function mockFixer(Closure $fixerClosure)
    {
        $fixerMock = $this->createMock(Fixer::class);

        $fixerClosure($fixerMock);

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
}
