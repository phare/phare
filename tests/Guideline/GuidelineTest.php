<?php

namespace Phare\Tests\Guideline;

use Phare\Assertion\Assertion;
use Phare\Guideline\Guideline;
use Phare\Rule\FileExtension;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\TestCase;

class GuidelineTest extends TestCase
{
    use TestFiles;

    public function test_it_add_assertion()
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
