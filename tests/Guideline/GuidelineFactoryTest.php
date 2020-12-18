<?php

namespace Phare\Tests\Guideline;

use Phare\Guideline\Guideline;
use Phare\Guideline\GuidelineFactory;
use Phare\Tests\Traits\TestFiles;
use PHPUnit\Framework\TestCase;

class GuidelineFactoryTest extends TestCase
{
    use TestFiles;

    public function test_it_make_guideline()
    {
        $guideline = GuidelineFactory::make('src/Guideline/preset/default.php');

        self::assertInstanceOf(Guideline::class, $guideline);

        self::assertCount(1, $guideline->getAssertions());
    }
}
