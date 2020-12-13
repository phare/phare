<?php

namespace Phare\Report;

use Phare\Assertion\Assertion;
use Phare\Kernel;
use Phare\Report\Formatter\Formatter;
use Phare\Report\Formatter\TextFormatter;
use Symfony\Component\Console\Style\SymfonyStyle;

class Report
{
    public const FORMATS = [
        'text' => TextFormatter::class,
    ];

    private SymfonyStyle $io;

    private int $progress = 0;

    private Formatter $formatter;

    private array $files;

    public function __construct(SymfonyStyle $io, Formatter $formatter)
    {
        $this->io = $io;
        $this->formatter = $formatter;
    }

    public function start(): void
    {
         if (!$this->io->isQuiet()) {
             $this->outputVersion();
        }
    }

    public function iterate(Assertion $assertion): void
    {
        $this->progress += 1;

        $this->addAssertionToFiles($assertion);

        if (!$this->io->isQuiet()) {
            $this->outputProgress($assertion);
        }
    }

    public function end(string $reportFile = null): void
    {
        if ($reportFile) {
            file_put_contents($reportFile, $this->formatter->output());
        }

        if (!$this->io->isQuiet()) {
            if (!$reportFile) {
                $this->outputReport($this->formatter->output());
            }

            $this->outputStatistics();
        }
    }

    protected function outputVersion(): void
    {
        $this->io->newLine();
        $this->io->writeln('Phare ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    protected function outputProgress(Assertion $assertion): void
    {
        // @TODO: replace with match
        $this->io->write([
            Assertion::STATUS_ERROR => '<fg=red>E</>',
            Assertion::STATUS_FIXED => '<fg=yellow>F</>',
            Assertion::STATUS_SUCCESS => '.',
        ][$assertion->status()]);

        if ($this->progress % 80 === 0) {
            $this->io->newLine();
        }
    }

    private function outputReport(string $output): void
    {
        $this->io->newLine(2);
        $this->io->writeln($output);
    }

    protected function outputStatistics(): void
    {
        $time = round(microtime(true) - PHARE_START, 3);
        $memory = round(memory_get_peak_usage() / 1024 / 1024);

        $this->io->newLine();
        $this->io->writeln("Time: {$time}s. Memory: {$memory}MB");
    }

    private function addAssertionToFiles(Assertion $assertion): void
    {
        $path = $assertion->getFile()->getRealPath();

        if (!isset($this->files[$path])) {
            $this->files[$path] = [];
        }

        $this->files[$path][] = $assertion;
    }
}
