<?php

namespace Phare\Report;

use Phare\Analysis\Analysis;
use Phare\Issue\Issue;
use Phare\Kernel;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Report
{
    private InputInterface $input;

    private OutputInterface $output;

    private SymfonyStyle $io;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $this->io = new SymfonyStyle($input, $output);
    }

    public function version(): void
    {
        $this->io->newLine();
        $this->io->write('Phare ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    public function initialiseProgressBar(int $length): ProgressBar
    {
        $section = $this->output->section();

        $progress = new ProgressBar($section);

        $progress->start($length);

        return $progress;
    }

    public function output(Analysis $analysis, string $format): void
    {
        foreach ($analysis->getScopes() as $scope) {
            $this->io->title('Scope: ' . $scope->getName());

            foreach ($scope->getFileCollection() as $file) {
                if (!$file->hasIssues()) {
                    continue;
                }

                $this->io->table(
                    ['[' . $file->getIssueCollection()->count() . '] ' . $file->getRealPath()],
                    $file->getIssueCollection()->map(function (Issue $issue) {
                        return [$issue->getMessage()];
                    })->toArray()
                );
            }

            $this->io->text($scope->getFileCollection()->count() . ' files analyzed.');
        }

        //$this->io->success('Done.');

        if ($this->io->isVeryVerbose()) {
            $this->statistics();
        }
    }

    private function statistics(): void
    {
        $this->io->title('Execution statistics:');
        $this->io->write('Phare executed in: ' . round(microtime(true) - WARDEN_START, 3) . 's');
    }
}
