<?php

namespace Phare\Guideline;

use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Scope as ScopePreset;

class GuidelineExtendsResolver
{

    public static function resolve(array $values, $extended = []): array
    {
        if (isset($values[GuidelinePreset::EXTENDS]) && $values[GuidelinePreset::EXTENDS] !== null) {
            $values = self::resolve($values[GuidelinePreset::EXTENDS], $values);
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
}
