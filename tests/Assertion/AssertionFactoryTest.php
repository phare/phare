<?php

namespace Phare\Tests\Assertion;

use Phare\Assertion\AssertionFactory;
use Phare\Kernel;
use Phare\Preset\Regex;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\FileExtension;
use Phare\Rule\FileRegex;
use Phare\Scope\ScopeFactory;
use Phare\Tests\TestCase;

class AssertionFactoryTest extends TestCase
{
    public function scopeFactory(): ScopeFactory
    {
        return Kernel::container()->get(ScopeFactory::class);
    }

    public function assertionFactory(): AssertionFactory
    {
        return Kernel::container()->get(AssertionFactory::class);
    }

    public function test_it_make_assertions(): void
    {
        $scope = $this->scopeFactory()->make(
            'default',
            [
                ScopePreset::PATHS => [
                    'tests/stubs/sub',
                ],

                ScopePreset::RULES => [
                    new FileExtension(['php']),
                    new FileRegex(Regex::PASCAL_CASE),
                ]
            ]
        );

        $assertions = iterator_to_array($this->assertionFactory()->make($scope));

        self::assertCount(2, $assertions);
    }
}
