<?php

namespace Phare\Console;

use Phare\Console\Command\InstallCommand;
use Phare\Console\Command\RunCommand;
use Phare\Kernel;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Phare', Kernel::VERSION);

        $run = new RunCommand;

        $this->add($run);
        $this->add(new InstallCommand());

        $this->setDefaultCommand($run->getName());
    }
}
