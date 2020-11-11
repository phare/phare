<?php

namespace NicolasBeauvais\Warden\Analysis;

use NicolasBeauvais\Warden\Guideline\Guideline;
use Symfony\Component\Finder\Finder;

class AnalysisFactory
{
    public static function make(Guideline $guideline): Analysis
    {
        $finder = new Finder();
        $analysis = new Analysis($guideline);

        // Push flattened file tree in the Analysis
        foreach ($guideline->getScopes() as $scopeName => $scope) {
            $files = $finder->ignoreUnreadableDirs()
                ->in($scope->getPaths())
                ->exclude($scope->getExcludes())
                ->files();

            $analysis->addFiles($files, $scope);
        }

        $analysis->execute();

        return $analysis;
    }
}
