<?php

namespace Phare\Scope;

use Phare\Preset\Scope as ScopePreset;
use Symfony\Component\Finder\Finder;

class ScopeFactory
{
    public static function make(string $name, array $values): Scope
    {
        ScopeValidator::validate($values);

        $scope = new Scope(
            $name,
            $values[ScopePreset::PATHS] ?? [],
            $values[ScopePreset::EXCLUDES] ?? [],
            $values[ScopePreset::RULES] ?? []
        );

        if (empty($scope->getPaths())) {
            return $scope;
        }

        $scope->setFinder(
            (new Finder())
                ->ignoreUnreadableDirs()
                ->notPath($scope->getExcludes())
                ->files()
                ->in($scope->getPaths())
        );

       return $scope;
    }
}
