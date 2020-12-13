<?php

namespace Phare\Report;

use Phare\Guideline\Guideline;
use Phare\Issue\Issue;
use Phare\Issue\IssueCollection;
use Phare\Kernel;
use Phare\Scope\Scope;
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
        $this->io->writeln('Phare ' . Kernel::VERSION . '.');
        $this->io->newLine();
    }

    public function initialiseProgressBar(int $length): ProgressBar
    {
        $section = $this->output->section();

        $progress = new ProgressBar($section);

        $progress->start($length);

        return $progress;
    }

    public function output(Guideline $guideline, string $format): void
    {
        foreach ($guideline->getScopes() as $scope) {
            $this->outputScope($scope);
        }

        if ($this->io->isVeryVerbose()) {
            $this->statistics();
        }
    }

    private function outputScope(Scope $scope): void
    {
        $this->io->title('Scope: ' . $scope->getName());

        $issueCollection = $scope->getIssueCollection();

        if ($issueCollection->isEmpty()) {
            $this->io->success('No issues found in scope.');
        } else {
            $this->reportScopeIssues($issueCollection);
        }

        $this->io->writeln($scope->getFileCollection()->count() . ' files analyzed.');
    }

    /**
     * @param IssueCollection $issueCollection
     */
    private function reportScopeIssues(IssueCollection $issueCollection): void
    {
        $this->io->warning($issueCollection->count() . ' issues found in scope.');
        $this->success = false;

        foreach ($issueCollection->groupByFile() as $file => $fileIssues) {
            $this->io->table(
                ['[' . count($fileIssues) . '] ' . $file],
                array_map(static fn(Issue $issue) => [$issue->getMessage()], $fileIssues)
            );
        }
    }

    private function statistics(): void
    {
        $this->io->title('Execution statistics:');
        $this->io->writeln('Phare executed in: ' . round(microtime(true) - WARDEN_START, 3) . 's');
    }

    public function success(): bool
    {
        return $this->success;
    }
}
