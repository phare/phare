<?php

namespace NicolasBeauvais\Warden\Report;

use NicolasBeauvais\Warden\Issue\IssueCollection;
use NicolasBeauvais\Warden\Kernel;
use Symfony\Component\Console\Style\SymfonyStyle;

class Report
{
    private SymfonyStyle $io;

    public function __construct(SymfonyStyle $io)
    {
        $this->io = $io;
    }

    public function version(): void
    {
        $this->io->newLine();
        $this->io->write('Warden ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    public function output(IssueCollection $issueCollection, string $format): void
    {
        $this->io->success('Done.');

        if ($this->io->isVeryVerbose()) {
            $this->statistics();
        }
    }

    private function statistics(): void
    {
        $this->io->title('Execution statistics:');
        $this->io->write('Warden executed in: ' . round(microtime(true) - WARDEN_START, 3) . 's');
    }
}
