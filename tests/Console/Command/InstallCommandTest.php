<?php

namespace Phare\Tests\Console\Command;

use Phare\Console\Command\InstallCommand;
use Phare\Tests\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class InstallCommandTest extends TestCase
{
    public function installCommandTester(): CommandTester
    {
        $application = new Application();
        $installCommand = new InstallCommand();

        $application->add($installCommand);

        return new CommandTester($installCommand);
    }

    public function test_it_detect_a_configuration_file_already_exists(): void
    {
        $tester = $this->installCommandTester();

        file_put_contents(__DIR__ . '/../../../phare.php', "<?php return [];\n");

        $tester->execute([]);

        $output = $tester->getDisplay();

        unlink(__DIR__ . '/../../../phare.php');

        self::assertStringContainsString('configuration file already exist', $output);
    }

    public function test_it_fail_if_wrong_preset(): void
    {
        $tester = $this->installCommandTester();

        $tester->execute(['preset' => 'wrong']);

        $output = $tester->getDisplay();

        self::assertStringContainsString('preset is invalid', $output);
    }

    public function test_it_ask_for_preset_if_not_set(): void
    {
        $tester = $this->installCommandTester();

        $tester->execute([]);

        $output = $tester->getDisplay();

        unlink(__DIR__ . '/../../../phare.php');

        self::assertStringContainsString('select your preferred configuration preset', $output);
    }

    public function test_it_create_configuration_file(): void
    {
        $tester = $this->installCommandTester();

        $tester->execute([
            'preset' => 'laravel',
        ]);

        $configurationFileContent = file_get_contents(__DIR__ . '/../../../phare.php');

        $output = $tester->getDisplay();

        unlink(__DIR__ . '/../../../phare.php');

        self::assertStringContainsString('Configuration file created', $output);
        self::assertStringContainsString('laravel', $output);
        self::assertStringContainsString('::laravel()', $configurationFileContent);
    }
}
