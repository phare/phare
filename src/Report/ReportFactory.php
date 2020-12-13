<?php


namespace Phare\Report;


use Phare\Exception\InvalidReportFormatException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ReportFactory
{
    public static function make(InputInterface $input, OutputInterface $output, string $format): Report
    {
        $formats = Report::FORMATS;

        if (!array_key_exists($format, $formats)) {
            throw new InvalidReportFormatException("Invalid report format specified: $format");
        }

        return new Report(
            new SymfonyStyle($input, $output),
            new $formats[$format]()
        );
    }
}
