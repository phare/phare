<?php

namespace Phare\Guideline;

use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;
use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Scope as ScopePreset;

#[Immutable]
class GuidelineParser
{
    public static function parse(array $values, $extended = []): array
    {
        if (isset($values[GuidelinePreset::EXTENDS]) && $values[GuidelinePreset::EXTENDS] !== null) {
            $values = self::parse($values[GuidelinePreset::EXTENDS], $values);
        }

        foreach ($values[GuidelinePreset::SCOPES] as $key => $scopes) {
            $extended[GuidelinePreset::SCOPES][$key] = isset($extended[GuidelinePreset::SCOPES][$key])
                ? self::mergeScopes($scopes, $extended[GuidelinePreset::SCOPES][$key])
                : $scopes;
        }

        return $extended;
    }

    #[Pure]
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

    #[Pure]
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