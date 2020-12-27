<?php

namespace Phare\Tests\Guideline;

use Phare\Exception\GuidelineConfigurationException;
use Phare\Guideline\GuidelineValidator;
use Phare\Kernel;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Scope as ScopePreset;
use Phare\Tests\TestCase;

class GuidelineValidatorTest extends TestCase
{
    public function guidelineValidator(): GuidelineValidator
    {
        return Kernel::container()->get(GuidelineValidator::class);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test_it_validate_guideline(): void
    {
        $this->guidelineValidator()->validate([
            GuidelinePreset::SCOPES => [
                '*' => [
                    ScopePreset::RULES => [],
                ],
            ],
        ]);
    }

    public function test_it_throw_exception_if_wrong_guideline_keys(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        $this->guidelineValidator()->validate(['wrong' => []]);
    }

    public function test_it_throw_exception_if_wrong_extends_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        $this->guidelineValidator()->validate([GuidelinePreset::EXTENDS => 'wrong']);
    }


    public function test_it_throw_exception_if_wrong_scopes_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        $this->guidelineValidator()->validate([GuidelinePreset::SCOPES => 'wrong']);
    }

    public function test_it_throw_exception_if_wrong_scopes_sub_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        $this->guidelineValidator()->validate([GuidelinePreset::SCOPES => [
            '*' => ''
        ]]);
    }
}
