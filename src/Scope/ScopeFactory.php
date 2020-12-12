<?php

namespace Phare\Scope;

use JetBrains\PhpStorm\Immutable;
use Phare\File\File;
use Phare\File\FileCollection;
use Phare\Preset\Scope as ScopePreset;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

#[Immutable]
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

        $collection = array_map(static function (SplFileInfo $file) {
            return new File($file);
        }, iterator_to_array($files));

        $scope->setFileCollection(
            new FileCollection($collection)
        );

       return $scope;
    }
}
