<?php

namespace Phare\Tests\Preset;

use Phare\Guideline\GuidelineValidator;
use Phare\Kernel;
use Phare\Tests\TestCase;

class PresetTest extends TestCase
{
    public function guidelineValidator(): GuidelineValidator
    {
        return Kernel::container()->get(GuidelineValidator::class);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test_it_has_valid_presets(): void
    {
        $path = __DIR__ . '/../../src/Guideline/preset/';

        foreach (array_diff(scandir($path), ['..', '.']) as $file) {
            $this->guidelineValidator()->validate(require $path . $file);
        }
    }
}
