<?php

namespace NicolasBeauvais\Warden\Console;

use NicolasBeauvais\Warden\Console\Command\RunCommand;
use NicolasBeauvais\Warden\Kernel;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Warden', Kernel::VERSION);

        $run = new RunCommand;

        $this->add($run);

        $this->setDefaultCommand($run->getName());
    }
}
