<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Preset\Guideline as GuidelinePreset;
use NicolasBeauvais\Warden\Scope\ScopeFactory;

class GuidelineFactory
{
    public static function make(string $filePath = null): Guideline
    {
        $guidelineCache = new GuidelineCache();

        $values = GuidelineFileLoader::load($filePath);

         if ($guidelineCache->exist($values)) {
             return $guidelineCache->load($values);
         }

        GuidelineValidator::validate($values);

        $values = GuidelineExtendsResolver::resolve($values);

        $guideline = new Guideline();

        foreach ($values[GuidelinePreset::SCOPES] as $name => $scope) {
            $guideline->addScope($name, ScopeFactory::make($scope));
        }

        $guidelineCache->put($values, $guideline);

        return $guideline;
    }
}
