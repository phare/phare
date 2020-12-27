<?php

namespace Phare\Tests\Scope;

use Phare\Exception\ScopeConfigurationException;
use Phare\Kernel;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\FileExtension;
use Phare\Scope\ScopeValidator;
use Phare\Tests\TestCase;

class ScopeValidatorTest extends TestCase
{
    public function scopeValidator(): ScopeValidator
    {
        return Kernel::container()->get(ScopeValidator::class);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function test_it_validate_scope(): void
    {
        $paths = [__DIR__ . '/../stubs'];
        $excludes = [__DIR__ . '/../stubs/excludes'];
        $rules = [new FileExtension(['php'])];

        $this->scopeValidator()->validate([
            ScopePreset::PATHS => $paths,
            ScopePreset::EXCLUDES => $excludes,
            ScopePreset::RULES => $rules
        ]);
    }

    public function test_it_throw_exception_if_wrong_scope_keys(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate(['wrong' => '']);
    }

    public function test_it_throw_exception_if_wrong_paths_type(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::PATHS => 'wrong']);
    }

    public function test_it_throw_exception_if_wrong_paths_values(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::PATHS => [[]]]);
    }

    public function test_it_throw_exception_if_wrong_excludes_type(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::EXCLUDES => 'wrong']);
    }

    public function test_it_throw_exception_if_wrong_excludes_values(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::EXCLUDES => [[]]]);
    }

    public function test_it_throw_exception_if_wrong_rules_type(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::RULES => 'wrong']);
    }

    public function test_it_throw_exception_if_wrong_rules_values(): void
    {
        $this->expectException(ScopeConfigurationException::class);

        $this->scopeValidator()->validate([ScopePreset::RULES => [[]]]);
    }
}
