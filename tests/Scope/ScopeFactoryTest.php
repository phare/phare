<?php

namespace Phare\Tests\Scope;

use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\FileExtension;
use Phare\Scope\Scope;
use Phare\Scope\ScopeFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

class ScopeFactoryTest extends TestCase
{
    public function test_it_make_scope(): void
    {
        $paths = [__DIR__ . '/../stubs'];
        $excludes = [__DIR__ . '/../stubs/excludes'];
        $rules = [new FileExtension(['php'])];

        $scope = ScopeFactory::make('test', [
            ScopePreset::PATHS => $paths,
            ScopePreset::EXCLUDES => $excludes,
            ScopePreset::RULES => $rules
        ]);

        self::assertEquals('test', $scope->getName());
        self::assertEquals($paths, $scope->getPaths());
        self::assertEquals($excludes, $scope->getExcludes());
        self::assertEquals($rules, $scope->getRules());
        self::assertInstanceOf(Finder::class, $scope->getFinder());
    }

        public function test_it_make_scope_empty(): void
    {
        $scope = ScopeFactory::make('test', []);

        self::assertEquals('test', $scope->getName());
        self::assertEquals([], $scope->getPaths());
        self::assertEquals([], $scope->getExcludes());
        self::assertEquals([], $scope->getRules());
        self::assertNull($scope->getFinder());
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

    public function test_it_get_and_set_finder(): void
    {
        $scope = new Scope('default', [], [], []);
        $finder = new Finder();

        self::assertNull($scope->getFinder());
        $scope->setFinder($finder);
        self::assertEquals($finder, $scope->getFinder());
    }
}
