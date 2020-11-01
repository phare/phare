<?php

namespace NicolasBeauvais\Warden\Guideline;

use NicolasBeauvais\Warden\Preset\Guideline as GuidelinePreset;
use NicolasBeauvais\Warden\Preset\Scope as ScopePreset;
use NicolasBeauvais\Warden\Scope\ScopeFactory;

class GuidelineFactory
{
    public static function make(array $values): Guideline
    {
        GuidelineValidator::validate($values);

        $values = self::resolveExtends($values);

        return self::mapValuesToGuideline($values);
    }

    private static function resolveExtends(array $values, array $extended = []): array
    {
        if (isset($values[GuidelinePreset::EXTENDS]) && $values[GuidelinePreset::EXTENDS] !== null) {
            $values = self::resolveExtends($values[GuidelinePreset::EXTENDS], $values);
        }

        foreach ($values[GuidelinePreset::SCOPES] as $key => $scopes) {
            $extended[GuidelinePreset::SCOPES][$key] = isset($extended[GuidelinePreset::SCOPES][$key])
                ? self::mergeScopes($scopes, $extended[GuidelinePreset::SCOPES][$key])
                : $scopes;
        }

        return $extended;
    }

    private static function mergeScopes(array $scope, array $extendedScope): array
    {
        if (isset($scope[ScopePreset::PATHS])) {
            $extendedScope[ScopePreset::PATHS] = isset($extendedScope[ScopePreset::PATHS])
                ? array_merge($scope[ScopePreset::PATHS], $extendedScope[ScopePreset::PATHS])
                : $scope[ScopePreset::PATHS];
        }

        if (isset($scope[ScopePreset::EXCLUDES])) {
            $extendedScope[ScopePreset::EXCLUDES] = isset($extendedScope[ScopePreset::EXCLUDES])
                ? array_merge($scope[ScopePreset::EXCLUDES], $extendedScope[ScopePreset::EXCLUDES])
                : $scope[ScopePreset::EXCLUDES];
        }

        if (isset($scope[ScopePreset::RULES])) {
            $extendedScope[ScopePreset::RULES] = isset($extendedScope[ScopePreset::RULES])
                ? self::mergeRules($scope[ScopePreset::RULES], $extendedScope[ScopePreset::RULES])
                : $scope[ScopePreset::RULES];
        }

        return $extendedScope;
    }

    private static function mergeRules(array $rules, array $extendedRules): array
    {
        $existingRules = [];

        foreach ($rules as $rule) {
            $existingRules[get_class($rule)] = $rule;
        }

        foreach ($extendedRules as $rule) {
            $existingRules[get_class($rule)] = $rule;
        }

        return array_values($existingRules);
    }

    private static function mapValuesToGuideline(array $values): Guideline
    {
        $guideline = new Guideline;

        foreach ($values[GuidelinePreset::SCOPES] as $name => $scope) {
            $guideline->addScope($name, ScopeFactory::make($scope));
        }

        return $guideline;
    }
}