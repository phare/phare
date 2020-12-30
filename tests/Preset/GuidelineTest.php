<?php

namespace Phare\Tests\Preset;

use Phare\Preset\Guideline;
use Phare\Tests\TestCase;

class GuidelineTest extends TestCase
{
    public function test_it_load_guidelines(): void
    {
        $path = __DIR__ . '/../../src/Guideline/preset/';

        foreach (array_diff(scandir($path), ['..', '.']) as $file) {
            $guideline = rtrim($file, '.php');

            self::assertEquals(
                require $path . $file,
                Guideline::$guideline()
            );
        }
    }
}
