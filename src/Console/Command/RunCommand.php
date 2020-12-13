<?php

namespace Phare\Console\Command;

use Phare\Guideline\GuidelineFactory;
use Phare\Report\ReportFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RunCommand extends Command
{
    protected static $defaultName = 'run';

    protected function configure(): void
    {
        $this
            ->setDescription('Run Phare')
            ->setHelp('This command trigger all configured Phare checks.')
            ->addOption(
                'configuration-file',
                null,
                InputOption::VALUE_REQUIRED,
                'Path to the Phare configuration file.',
                'phare.php'
            )
            ->addOption(
                'report-format',
                null,
                InputOption::VALUE_REQUIRED,
                'Format of the output report.',
                'text'
            )
            ->addOption(
                'report-file',
                null,
                InputOption::VALUE_REQUIRED,
                'Write the report to the specified file path.',
            )
            ->addOption(
                'fix',
                null,
                InputOption::VALUE_NONE,
                'Try to automatically fix problems.',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $report = ReportFactory::make($input, $output, $input->getOption('report-format'));
        $guideline = GuidelineFactory::make($input->getOption('configuration-file'));

        $report->start();

        foreach ($guideline->getAssertions() as $assertion) {
            $assertion->perform($input->getOption('fix'));

            $report->iterate($assertion);

            if (!$assertion->successful()) {
                // $report->addIssue($assertion)
            }
        }

        // Execute Report with report-format and report-file
        // $report->output($guideline, $input->getOption('report-format'));

        $report->end($input->getOption('report-file'));

        return Command::SUCCESS;
        //return $report->success() ? Command::SUCCESS : Command::FAILURE;
    }
}
