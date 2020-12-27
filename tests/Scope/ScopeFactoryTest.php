<?php

namespace Phare\Tests\Scope;

use Phare\Exception\ScopeDirectoryNotFoundException;
use Phare\Kernel;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\FileExtension;
use Phare\Scope\Scope;
use Phare\Scope\ScopeFactory;
use Phare\Tests\TestCase;

class ScopeFactoryTest extends TestCase
{
    public function scopeFactory(): ScopeFactory
    {
        return Kernel::container()->get(ScopeFactory::class);
    }

    public function test_it_make_scope(): void
    {
        $paths = [__DIR__ . '/../stubs/'];
        $excludes = [__DIR__ . '/../stubs/excludes/'];
        $rules = [new FileExtension(['php'])];

        $scope = $this->scopeFactory()->make('test', [
            ScopePreset::PATHS => $paths,
            ScopePreset::EXCLUDES => $excludes,
            ScopePreset::RULES => $rules
        ]);

        self::assertEquals('test', $scope->getName());
        self::assertEquals($paths, $scope->getPaths());
        self::assertEquals($excludes, $scope->getExcludes());
        self::assertEquals($rules, $scope->getRules());
        self::assertNotNull($scope->getFinder());
    }

    public function test_it_make_scope_with_no_trailing_slash(): void
    {
        $paths = [__DIR__ . '/../stubs'];
        $excludes = [__DIR__ . '/../stubs/excludes'];
        $rules = [new FileExtension(['php'])];

        $scope = $this->scopeFactory()->make('test', [
            ScopePreset::PATHS => $paths,
            ScopePreset::EXCLUDES => $excludes,
            ScopePreset::RULES => $rules
        ]);

        self::assertEquals('test', $scope->getName());
        self::assertEquals([__DIR__ . '/../stubs/'], $scope->getPaths());
        self::assertEquals($excludes, $scope->getExcludes());
        self::assertEquals($rules, $scope->getRules());
        self::assertNotNull($scope->getFinder());
    }

    public function test_it_make_scope_with_relative_paths(): void
    {
        $paths = ['tests/stubs'];
        $excludes = ['tests/stubs/excludes'];
        $rules = [new FileExtension(['php'])];

        $scope = $this->scopeFactory()->make('test', [
            ScopePreset::PATHS => $paths,
            ScopePreset::EXCLUDES => $excludes,
            ScopePreset::RULES => $rules
        ]);

        self::assertEquals('test', $scope->getName());
        self::assertEquals([Kernel::getProjectRoot() . 'tests/stubs/'], $scope->getPaths());
        self::assertEquals($excludes, $scope->getExcludes());
        self::assertEquals($rules, $scope->getRules());
        self::assertNotNull($scope->getFinder());
    }

    public function test_it_make_scope_default(): void
    {
        $scope = $this->scopeFactory()->make('test', []);

        self::assertEquals('test', $scope->getName());
        self::assertEquals([Kernel::getProjectRoot()], $scope->getPaths());
        self::assertEquals([], $scope->getExcludes());
        self::assertEquals([], $scope->getRules());
        self::assertNotNull($scope->getFinder());
    }

    public function test_it_throw_exception_if_path_doesnt_exist(): void
    {
        $this->expectException(ScopeDirectoryNotFoundException::class);

        $this->scopeFactory()->make('test', [
            ScopePreset::PATHS => ['/wrong']
        ]);
    }

    public function test_it_get_scope_paths(): void
    {
        $scope = new Scope('default', ['paths'], [], []);

        self::assertEquals(['paths'], $scope->getPaths());
    }

    public function test_it_get_scope_excludes(): void
    {
        $scope = new Scope('default', [], ['excludes'], []);

        self::assertEquals(['excludes'], $scope->getExcludes());
    }

    public function test_it_get_scope_rules(): void
    {
        $scope = new Scope('default', [], [], ['rules']);

        self::assertEquals(['rules'], $scope->getRules());
    }
}
