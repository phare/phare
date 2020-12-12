<?php

namespace Phare\Console\Command;

use Phare\Analysis\AnalysisFactory;
use Phare\Guideline\GuidelineFactory;
use Phare\Guideline\GuidelineIssueCollector;
use Phare\Guideline\GuidelineProcessor;
use Phare\Report\Report;
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
                'c',
                InputOption::VALUE_REQUIRED,
                'Path to the Phare configuration file.',
                null
            )
            ->addOption(
                'output-format',
                'o',
                InputOption::VALUE_REQUIRED,
                'Path to the Phare configuration file.',
                'text'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $report = new Report($input, $output);

        $report->version();

        $guideline = GuidelineFactory::make(
            $input->getOption('configuration-file')
        );

        $analysis = AnalysisFactory::make($guideline, $report);

        $report->output(
            $analysis,
            $input->getOption('output-format')
        );

        return Command::SUCCESS;
    }
}
