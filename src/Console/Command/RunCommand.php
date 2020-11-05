<?php

namespace NicolasBeauvais\Warden\Console\Command;

use NicolasBeauvais\Warden\Analysis\AnalysisFactory;
use NicolasBeauvais\Warden\Guideline\GuidelineFactory;
use NicolasBeauvais\Warden\Guideline\GuidelineIssueCollector;
use NicolasBeauvais\Warden\Report\Report;
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
            ->setDescription('Run Warden')
            ->setHelp('This command trigger all configured Warden checks.')
            ->addOption(
                'configuration-file',
                'c',
                InputOption::VALUE_REQUIRED,
                'Path to the Warden configuration file.',
                null
            )
            ->addOption(
                'output-format',
                'o',
                InputOption::VALUE_REQUIRED,
                'Path to the Warden configuration file.',
                'text'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $report = new Report(
            new SymfonyStyle($input, $output)
        );

        $report->version();

        $guideline = GuidelineFactory::make(
            $input->getOption('configuration-file')
        );

        $analysis = AnalysisFactory::make($guideline);

        $report->output(
            $analysis->getIssueCollection(),
            $input->getOption('output-format')
        );

        return Command::SUCCESS;
    }
}
