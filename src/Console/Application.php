<?php

namespace Phare\Console;

use League\Container\Container;
use Phare\Console\Command\InstallCommand;
use Phare\Console\Command\RunCommand;
use Phare\Kernel;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct(Container $container)
    {
        parent::__construct('Phare', Kernel::VERSION);

        $commands = [
            RunCommand::class,
            InstallCommand::class
        ];

        foreach ($commands as $command) {
            $this->add(
                $container->get($command)
            );
        }

        $this->setDefaultCommand(RunCommand::NAME);
    }
}
