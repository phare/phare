<?php

namespace Phare\Tests\Console;

use Phare\Console\Application;
use Phare\Kernel;
use Phare\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function test_it_define_commands()
    {
        $application = new Application(Kernel::container());

        self::assertTrue($application->has('run'));
        self::assertTrue($application->has('install'));
    }
}
