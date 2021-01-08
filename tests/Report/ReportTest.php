<?php

namespace Phare\Tests\Report;

use Closure;
use Phare\Assertion\Assertion;
use Phare\Kernel;
use Phare\Report\Formatter\CommandLineFormatter;
use Phare\Report\Report;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Style\SymfonyStyle;

class ReportTest extends TestCase
{
    use TestFiles;

    protected function makeReport(Closure $symfonyStyleClosure = null): Report
    {
        $symfonyStyleMock = $this->createMock(SymfonyStyle::class);

        if ($symfonyStyleClosure) {
            $symfonyStyleClosure($symfonyStyleMock);
        }

        return new Report($symfonyStyleMock, new CommandLineFormatter());
    }

    public function test_it_start(): void
    {
        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->once())
                ->method('isQuiet')
                ->willReturn(false);
            $mock->expects($this->once())
                ->method('writeln')
                ->with($this->stringContains(Kernel::VERSION));
        });

        $report->start();
    }

    public function test_it_start_quiet(): void
    {
        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->once())
                  ->method('isQuiet')
                  ->willReturn(true);
        });

        $report->start();
    }

    public function test_it_iterate(): void
    {
        $assertion = new Assertion('default', $this->stubFile('StubTest.php'), new FileExtension(['php']));

        $assertion->perform(false);

        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->once())->method('isQuiet')->willReturn(false);
            $mock->expects($this->once())->method('write');
        });

        $report->iterate($assertion);

        self::assertEquals(1, $report->getStatistics()['total']);
        self::assertEquals(1, $report->getStatistics()[Assertion::STATUS_SUCCESS]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_FIXED]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_ERROR]);
    }

    public function test_it_iterate_error(): void
    {
        $assertion = new Assertion('default', $this->stubFile('StubTest.php'), new FileExtension(['js']));

        $assertion->perform(false);

        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->once())->method('isQuiet')->willReturn(false);
            $mock->expects($this->once())->method('write');
        });

        $report->iterate($assertion);

        self::assertEquals(1, $report->getStatistics()['total']);
        self::assertEquals(1, $report->getStatistics()[Assertion::STATUS_ERROR]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_SUCCESS]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_FIXED]);
    }

    public function test_it_iterate_quiet(): void
    {
        $assertion = new Assertion('default', $this->stubFile('StubTest.php'), new FileExtension(['php']));

        $assertion->perform(false);

        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->once())->method('isQuiet')->willReturn(true);
            $mock->expects($this->never())->method('write');
        });

        $report->iterate($assertion);

        self::assertEquals(1, $report->getStatistics()['total']);
        self::assertEquals(1, $report->getStatistics()[Assertion::STATUS_SUCCESS]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_FIXED]);
        self::assertEquals(0, $report->getStatistics()[Assertion::STATUS_ERROR]);
    }

    public function test_it_end(): void
    {
        define('PHARE_START', microtime(true));

        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->atLeastOnce())->method('write');
            $mock->expects($this->atLeastOnce())
                ->method('isQuiet')
                ->willReturn(false);
        });

        $report->end();
    }

    public function test_it_end_quiet(): void
    {
        $report = $this->makeReport(function (MockObject $mock) {
            $mock->expects($this->never())->method('write');
            $mock->expects($this->atLeastOnce())
                ->method('isQuiet')
                ->willReturn(true);
        });

        $report->end();
    }
}
