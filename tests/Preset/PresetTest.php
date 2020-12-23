<?php

namespace Phare\Tests\Preset;

use Phare\Guideline\GuidelineValidator;
use PHPUnit\Framework\TestCase;

class PresetTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function test_it_has_valid_presets(): void
    {
        $path = __DIR__ . '/../../src/Guideline/preset/';

        foreach (array_diff(scandir($path), ['..', '.']) as $file) {
            GuidelineValidator::validate(require $path . $file);
        }
    }
}
