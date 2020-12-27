<?php

namespace Phare\Tests\Guideline;

use Phare\Guideline\GuidelineFactory;
use Phare\Kernel;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class GuidelineFactoryTest extends TestCase
{
    use TestFiles;

    public function guidelineFactory(): GuidelineFactory
    {
        return Kernel::container()->get(GuidelineFactory::class);
    }

    public function test_it_make_guideline(): void
    {
        $guideline = $this->guidelineFactory()->make('src/Guideline/preset/default.php');

        self::assertNotEmpty($guideline->getAssertions());
    }
}
