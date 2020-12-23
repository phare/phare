<?php

namespace Phare\Guideline;

use Phare\Assertion\AssertionFactory;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Scope\ScopeFactory;

abstract class GuidelineFactory
{
    public static function make(string $filePath): Guideline
    {
        $values = GuidelineFileLoader::load($filePath);

        GuidelineValidator::validate($values);

        $values = GuidelineParser::parse($values);

        $guideline = new Guideline();

        foreach ($values[GuidelinePreset::SCOPES] as $name => $scopeValues) {
            $scope = ScopeFactory::make($name, $scopeValues);

            foreach (AssertionFactory::make($scope) as $assertion) {
                $guideline->addAssertion($assertion);
            }
        }

        return $guideline;
    }
}
