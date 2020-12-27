<?php

namespace Phare\Tests\Report\Formatter;

use Phare\Assertion\Assertion;
use Phare\Report\Formatter\CommandLineFormatter;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class CommandLineFormatterTest extends TestCase
{
    use TestFiles;

    public function test_it_output(): void
    {
        $assertions = [
            new Assertion('default', $this->stubFile('StubTest.php'), new FileExtension(['php']))
        ];

        $output = (new CommandLineFormatter())->output($assertions);

        self::assertNotEmpty($output);
        self::assertStringContainsString('StubTest.php', $output);
    }
}
