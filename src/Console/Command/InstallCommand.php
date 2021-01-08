<?php

namespace Phare\Console\Command;

use Exception;
use Phare\Kernel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class InstallCommand extends Command
{
    public const PRESET_PATH = __DIR__ . '/../../Guideline/preset/';
    public const STUB_CONFIG_PATH = __DIR__ . '/../../../stubs/phare.stub';

    protected static $defaultName = 'install';

    protected function configure(): void
    {
        $this
            ->setDescription('Install Phare')
            ->setHelp('Create a default Phare configuration for your project.')
            ->addArgument(
                'preset',
                InputArgument::OPTIONAL,
                'Preset to use for the configuration file',
                null,
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string|null $preset */
        $preset = $input->getArgument('preset');
        $configPath = Kernel::getProjectRoot() . 'phare.php';
        $io = new SymfonyStyle($input, $output);

        if (file_exists($configPath) && !$this->shouldOverwrite($input, $output)) {
            return Command::SUCCESS;
        }

        $fileContent = file_get_contents(self::STUB_CONFIG_PATH);

        if (!$fileContent) {
            $io->error("Could not read content of the stub configuration file.");
            return Command::FAILURE;
        }

        if (!is_null($preset) && !$this->isValidPreset($preset)) {
            $io->error("The '$preset' preset is invalid");
            return Command::FAILURE;
        }

        if (is_null($preset)) {
            $preset = $this->askForPreset($input, $output);
        }

        file_put_contents(
            $configPath,
            str_replace('%preset%', $preset, $fileContent)
        );

        $io->success("Configuration file created with preset [$preset] in $configPath");

        return Command::SUCCESS;
    }

    private function allowedPresets(): array
    {
        return array_values(array_map(
            static fn(SplFileInfo $file) => $file->getFilenameWithoutExtension(),
            iterator_to_array((new Finder())->files()->in(self::PRESET_PATH))
        ));
    }

    private function shouldOverwrite(InputInterface $input, OutputInterface $output): bool
    {
        $question = new ConfirmationQuestion(
            'A phare.php configuration file already exist for this project. Would you like to Overwrite it? (Y/n)',
            false
        );

        return $this->getHelper('question')->ask($input, $output, $question);
    }

    private function askForPreset(InputInterface $input, OutputInterface $output): string
    {
        $question = new ChoiceQuestion(
            'Please select your preferred configuration preset (Press enter for default)',
            $this->allowedPresets(),
            'default'
        );

        $question->setErrorMessage('Preset %s is invalid.');

        return $this->getHelper('question')->ask($input, $output, $question);
    }

    private function isValidPreset(string $preset): bool
    {
        return in_array(strtolower($preset), $this->allowedPresets(), true);
    }
}
