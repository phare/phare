<?php

namespace Phare\Scope;

use Phare\Exception\ScopeDirectoryNotFoundException;
use Phare\Kernel;
use Phare\Preset\Scope as ScopePreset;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;
use Symfony\Component\Finder\Finder;

class ScopeFactory
{
    public static function make(string $name, array $values): Scope
    {
        ScopeValidator::validate($values);

        $paths = self::makePathsAbsolute($values[ScopePreset::PATHS] ?? [Kernel::getProjectRoot()]);
        $excludes = $values[ScopePreset::EXCLUDES] ?? [];

        $scope = new Scope($name, $paths, $excludes, $values[ScopePreset::RULES] ?? []);

        try {
            $finder = (new Finder())
                ->ignoreUnreadableDirs()
                ->exclude($scope->getExcludes())
                ->files()
                ->in($scope->getPaths());
        } catch (DirectoryNotFoundException $exception) {
            throw new ScopeDirectoryNotFoundException($exception->getMessage());
        }

        $scope->setFinder($finder);

        return $scope;
    }

    private static function makePathsAbsolute(array $paths): array
    {
        foreach ($paths as &$path) {
            if (strpos($path, DIRECTORY_SEPARATOR) !== 0) {
                $path = Kernel::getProjectRoot() . $path;
            }

            $path = rtrim($path, '/') . '/';
        } unset($path);

        return $paths;
    }
}
