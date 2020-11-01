<?php

namespace NicolasBeauvais\Warden\Console\Command;

use NicolasBeauvais\Warden\Guideline\GuidelineCache;
use NicolasBeauvais\Warden\Guideline\GuidelineFactory;
use NicolasBeauvais\Warden\Guideline\GuidelineFileLoader;
use NicolasBeauvais\Warden\Guideline\GuidelineValidator;
use NicolasBeauvais\Warden\Kernel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use const http\Client\Curl\Features\KERBEROS4;

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
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $guidelineCache = new GuidelineCache();
        $io = new SymfonyStyle($input, $output);

        $io->newLine();
        $io->write('Warden ' . Kernel::VERSION . '.');
        $io->newLine();

        $values = GuidelineFileLoader::load(
            $input->getOption('configuration-file')
        );

        $guideline = $guidelineCache->exist($values)
            ? $guidelineCache->load($values)
            : GuidelineFactory::make($values);

        // Done - Load / Merge configuration file
        // Done - Validate configuration file format
        // Load file tree from cache if same hash
        // Create file tree and associate each file with it's scope
        // Save file tree in cache
        // Run all scopes in parallel
          // Run all Rules of the scope in parallel
        // Output the result

        $io->success('Done.');

        return Command::SUCCESS;
    }
}
