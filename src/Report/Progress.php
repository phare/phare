<?php

namespace Phare\Report;

use Phare\Kernel;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Progress
{
    private SymfonyStyle $io;

    private int $total = 0;

    private int $progress = 0;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    public function version(): void
    {
        if ($this->io->isQuiet()) {
            return;
        }

        $this->io->newLine();
        $this->io->writeln('Phare ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    public function statistics(): void
    {
        if ($this->io->isQuiet() || !$this->io->isVeryVerbose()) {
            return;
        }

        $this->io->title('Execution statistics:');
        $this->io->writeln('Phare executed in: ' . round(microtime(true) - WARDEN_START, 3) . 's');
    }

    public function start(int $total): void
    {
        $this->total = $total;
    }

    public function iterate(bool $success): void
    {
        $this->io->write($success ? '.' : 'E');
        $this->progress += 1;

        if ($this->progress % 65 === 0 || $this->progress === $this->total) {
            $this->io->newLine();
        }
    }
}
