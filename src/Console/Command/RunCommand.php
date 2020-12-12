<?php

namespace Phare\Console\Command;

use Phare\Analysis\AnalysisFactory;
use Phare\Guideline\GuidelineFactory;
use Phare\Report\Report;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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

        foreach ($guideline->getScopes() as $scope) {
            $progress = $report->initialiseProgressBar($scope->countRules());

            foreach ($progress->iterate($scope->getRules()) as $rule) {
                $rule->handle($scope);
            }

            $report->addScope($scope);
        }

        $report->output($input->getOption('output-format'));

        return Command::SUCCESS;
    }
}
