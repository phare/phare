<?php

namespace Phare\Tests\Console\Command;

use Closure;
use Phare\Assertion\Assertion;
use Phare\Console\Command\RunCommand;
use Phare\File\File;
use Phare\Guideline\Guideline;
use Phare\Guideline\GuidelineFactory;
use Phare\Report\ReportFactory;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class RunCommandTest extends TestCase
{
    public function runCommandTester($reportFactory, $guidelineFactory): CommandTester
    {
        $application = new Application();
        $runCommand = new RunCommand(
            $reportFactory,
            $guidelineFactory
        );

        $application->add($runCommand);

        return new CommandTester($runCommand);
    }

    public function test_it_has_name_constant(): void
    {
        self::assertEquals('run', RunCommand::NAME);
    }

    public function test_it_execute(): void
    {
        $guidelineFactoryMock = $this->createMock(GuidelineFactory::class);
        $assertionMock = $this->createMock(Assertion::class);

        $assertionMock->expects(self::once())
            ->method('perform')
            ->with(false)
            ->willReturnSelf();

        $assertionMock->expects(self::atLeastOnce())
            ->method('getStatus')
            ->willReturn(Assertion::STATUS_SUCCESS);

        $guideline = new Guideline();
        $guideline->addAssertion($assertionMock);

        $guidelineFactoryMock->expects(self::once())
            ->method('make')
            ->willReturn($guideline);

        $tester = $this->runCommandTester(
            new ReportFactory(),
            $guidelineFactoryMock
        );

        $tester->execute([]);

        $output = $tester->getDisplay();

        self::assertStringContainsString('1 assertions, 0 errors', $output);
    }

    public function test_it_execute_with_empty_guideline(): void
    {
        $guidelineFactoryMock = $this->createPartialMock(GuidelineFactory::class, ['make']);

        $guidelineFactoryMock->expects(self::once())
            ->method('make')
            ->willReturn(new Guideline());

        $tester = $this->runCommandTester(
            new ReportFactory(),
            $guidelineFactoryMock
        );

        $tester->execute([]);

        $output = $tester->getDisplay();

        self::assertStringContainsString('0 assertions, 0 errors', $output);
    }
}
