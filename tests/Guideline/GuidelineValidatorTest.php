<?php

namespace Phare\Tests\Guideline;

use Phare\Exception\GuidelineConfigurationException;
use Phare\Guideline\GuidelineValidator;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Scope as ScopePreset;
use PHPUnit\Framework\TestCase;

class GuidelineValidatorTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function test_it_validate_guideline(): void
    {
        GuidelineValidator::validate([
            GuidelinePreset::EXTENDS => GuidelinePreset::default(),
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

        GuidelineValidator::validate(['wrong' => []]);
    }

     public function test_it_throw_exception_if_wrong_extends_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        GuidelineValidator::validate([GuidelinePreset::EXTENDS => 'wrong']);
    }


    public function test_it_throw_exception_if_wrong_scopes_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        GuidelineValidator::validate([GuidelinePreset::SCOPES => 'wrong']);
    }

    public function test_it_throw_exception_if_wrong_scopes_sub_type(): void
    {
        $this->expectException(GuidelineConfigurationException::class);

        GuidelineValidator::validate([GuidelinePreset::SCOPES => [
            '*' => ''
        ]]);
    }

}
