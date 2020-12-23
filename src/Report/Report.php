<?php

namespace Phare\Report;

use Phare\Assertion\Assertion;
use Phare\Kernel;
use Phare\Report\Formatter\CommandLineFormatter;
use Phare\Report\Formatter\Formatter;
use Symfony\Component\Console\Style\SymfonyStyle;

class Report
{
    public const FORMATS = [
        'default' => CommandLineFormatter::class,
    ];

    private array $statistics = [
        'total' => 0,
        Assertion::STATUS_SUCCESS => 0,
        Assertion::STATUS_FIXED => 0,
        Assertion::STATUS_ERROR => 0,
    ];

    /**
     * @var Assertion[]
     */
    private array $assertions;

    private SymfonyStyle $io;

    private Formatter $formatter;

    public function __construct(SymfonyStyle $io, Formatter $formatter)
    {
        $this->io = $io;
        $this->formatter = $formatter;
    }

    public function start(): void
    {
        if ($this->io->isQuiet()) {
             return;
        }

        $this->outputVersion();
    }

    public function iterate(Assertion $assertion): void
    {
        $this->statistics['total'] += 1;
        $this->statistics[$assertion->getStatus()] += 1;

        $this->addAssertion($assertion);

        if ($this->io->isQuiet()) {
            return;
        }

        $this->outputProgress($assertion);
    }

    public function end(string $reportFile = null): void
    {
        $this->io->newLine();

        $this->outputReport($reportFile);

        if ($this->io->isQuiet()) {
            return;
        }

        $this->outputStatistics();
    }

    public function successful(): bool
    {
        return count($this->assertions) === 0;
    }

    private function outputVersion(): void
    {
        $this->io->newLine();
        $this->io->writeln('Phare ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    private function outputProgress(Assertion $assertion): void
    {
        $this->io->write([
            Assertion::STATUS_ERROR => '<fg=red>E</>',
            Assertion::STATUS_FIXED => '<fg=yellow>F</>',
            Assertion::STATUS_SUCCESS => '.',
        ][$assertion->getStatus()]);

        if ($this->statistics['total'] % 80 === 0) {
            $this->io->newLine();
        }
    }

    private function outputReport(string $reportFile = null): void
    {
        if ($reportFile) {
            file_put_contents($reportFile, $this->formatter->output($this->assertions));
        } elseif (!$this->io->isQuiet() && !$this->successful()) {
            $this->io->newLine();
            $this->io->write($this->formatter->output($this->assertions));
        }
    }

    private function outputStatistics(): void
    {
        $time = round(microtime(true) - PHARE_START, 3);
        $memory = round(memory_get_peak_usage() / 1024 / 1024);

        $this->io->newLine();

        $this->io->write($this->successful() ? '<bg=green;fg=black>OK (' : '<bg=red;fg=black>FAILURE (');
        $this->io->write($this->statistics['total'] . ' assertions, ');
        $this->io->write($this->statistics[Assertion::STATUS_ERROR] . ' errors');

        if ($this->statistics[Assertion::STATUS_FIXED]) {
            $this->io->write(', ' . $this->statistics[Assertion::STATUS_FIXED] . ' fixed');
        }

        $this->io->write(')</>');

        $this->io->newLine(2);
        $this->io->writeln("Time: {$time}s, Memory: {$memory}MB");
    }

    private function addAssertion(Assertion $assertion): void
    {
        if ($assertion->successful()) {
            return;
        }

        $this->assertions[] = $assertion;
    }
}
