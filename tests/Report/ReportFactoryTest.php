<?php

namespace Phare\Tests\Report;

use Phare\Exception\InvalidReportFormatException;
use Phare\Report\Formatter\CommandLineFormatter;
use Phare\Report\ReportFactory;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;

class ReportFactoryTest extends TestCase
{
    use TestFiles;

    public function test_it_make(): void
    {
        $input = new ArrayInput([]);
        $output = new StreamOutput(fopen('php://memory', 'rb'));

        $report = (new ReportFactory())->make($input, $output, 'default');

        self::assertInstanceOf(CommandLineFormatter::class, $report->getFormatter());
    }

    public function test_it_throw_exception_when_making_with_bad_formatter(): void
    {
        $input = new ArrayInput([]);
        $output = new StreamOutput(fopen('php://memory', 'rb'));

        $this->expectException(InvalidReportFormatException::class);

        (new ReportFactory())->make($input, $output, 'wrong');
    }
}
