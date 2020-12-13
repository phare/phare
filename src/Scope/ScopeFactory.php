<?php

namespace Phare\Scope;

use JetBrains\PhpStorm\Immutable;
use Phare\Preset\Scope as ScopePreset;
use Symfony\Component\Finder\Finder;

#[Immutable]
class ScopeFactory
{
    public static function make(string $name, array $values): Scope
    {
        $scope = new Scope(
            $name,
            $values[ScopePreset::PATHS] ?? ['*'],
            $values[ScopePreset::EXCLUDES] ?? [],
            $values[ScopePreset::RULES] ?? []
        );

        if (empty($scope->getPaths())) {
            return $scope;
        }

        $scope->setFinder(
            (new Finder())->files()
                ->ignoreUnreadableDirs()
                ->exclude($scope->getExcludes())
                ->in($scope->getPaths())
        );

       return $scope;
    }
}
