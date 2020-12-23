<?php

namespace Phare\Tests\Guideline;

use Phare\Guideline\GuidelineFactory;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\TestCase;

class GuidelineFactoryTest extends TestCase
{
    use TestFiles;

    public function test_it_make_guideline(): void
    {
        $guideline = GuidelineFactory::make('src/Guideline/preset/default.php');

        self::assertNotEmpty($guideline->getAssertions());
    }
}
