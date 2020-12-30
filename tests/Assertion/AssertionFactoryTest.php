<?php

namespace Phare\Tests\Assertion;

use Phare\Assertion\AssertionFactory;
use Phare\Exception\FileDoesNotExistException;
use Phare\Kernel;
use Phare\Preset\Regex;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\FileExtension;
use Phare\Rule\FileRegex;
use Phare\Scope\ScopeFactory;
use Phare\Tests\TestCase;
use Phare\Tests\Traits\TestFiles;

class AssertionFactoryTest extends TestCase
{
    use TestFiles;

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

    public function test_does_not_make_assertions_if_no_rules(): void
    {
        $scope = $this->scopeFactory()->make(
            'default',
            [
                ScopePreset::PATHS => [
                    'tests/stubs/sub',
                ]
            ]
        );

        $assertions = iterator_to_array($this->assertionFactory()->make($scope));

        self::assertCount(0, $assertions);
    }

    public function test_it_throw_exception_if_file_does_not_exist(): void
    {
        $this->createStubFile('sub/StubTest2.php');

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

        $this->expectException(FileDoesNotExistException::class);

        foreach ($this->assertionFactory()->make($scope) as $assertion) {
            $this->deleteStubFile('sub/StubTest2.php');
        }
    }
}
