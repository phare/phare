<?php

namespace NicolasBeauvais\Warden\Scope;

use NicolasBeauvais\Warden\File\FileCollection;
use NicolasBeauvais\Warden\Preset\Scope as ScopePreset;
use Symfony\Component\Finder\Finder;

class ScopeFactory
{
    public static function make(string $name, array $values): Scope
    {
        $finder = new Finder;
        $scope = new Scope(
            $name,
            $values[ScopePreset::PATHS] ?? ['*'],
            $values[ScopePreset::EXCLUDES] ?? [],
            $values[ScopePreset::RULES] ?? []
        );

        $files = $finder->ignoreUnreadableDirs()
                ->in($scope->getPaths())
                ->exclude($scope->getExcludes())
                ->files();

        $scope->setFileCollection(new FileCollection($files));

       return $scope;
    }
}
