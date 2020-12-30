<?php

namespace Phare\Tests\Guideline;

use Phare\Assertion\Assertion;
use Phare\Guideline\Guideline;
use Phare\Rule\FileExtension;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class GuidelineTest extends TestCase
{
    use TestFiles;

    public function test_it_add_assertion(): void
    {
        $guideline = new Guideline();
        $assertion = new Assertion(
            'default',
            $this->stubFile('stub.php'),
            new FileExtension(['php'])
        );

        self::assertEmpty($guideline->getAssertions());

        $guideline->addAssertion($assertion);

        self::assertEquals([$assertion], $guideline->getAssertions());
    }
}
