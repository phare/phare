<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Preset\Guideline as GuidelinePreset;
use NicolasBeauvais\Warden\Scope\ScopeFactory;

class GuidelineFactory
{
    public static function make(string $filePath = null): Guideline
    {
        $values = GuidelineFileLoader::load($filePath);

        GuidelineValidator::validate($values);

        $values = GuidelineExtendsResolver::resolve($values);

        $guideline = new Guideline();

        foreach ($values[GuidelinePreset::SCOPES] as $name => $scopeValues) {
            $scope = ScopeFactory::make($name, $scopeValues);

            if (count($scope->getRules())) {
                $guideline->addScope($name, $scope);
            }
        }

        return $guideline;
    }
}
