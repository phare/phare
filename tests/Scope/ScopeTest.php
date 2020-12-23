<?php

namespace Phare\Tests\Scope;

use Phare\Scope\Scope;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

class ScopeTest extends TestCase
{
    public function test_it_get_scope_name(): void
    {
        $scope = new Scope('default', [], [], []);

        self::assertEquals('default', $scope->getName());
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

        $scope->setFinder($finder);
        self::assertEquals($finder, $scope->getFinder());
    }
}
