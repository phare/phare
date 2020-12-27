<?php

namespace Phare\Guideline;

use Phare\Preset\Guideline as GuidelinePreset;
use Phare\Preset\Scope as ScopePreset;

class GuidelineParser
{
    public function parse(array $values, array $extended = []): array
    {
        if (isset($values[GuidelinePreset::EXTENDS]) && $values[GuidelinePreset::EXTENDS] !== null) {
            $values = $this->parse($values[GuidelinePreset::EXTENDS], $values);
        }

        foreach ($values[GuidelinePreset::SCOPES] as $key => $scope) {
            $extended[GuidelinePreset::SCOPES][$key] = isset($extended[GuidelinePreset::SCOPES][$key])
                ? $this->mergeScopes($scope, $extended[GuidelinePreset::SCOPES][$key])
                : $scope;
        }

        return $extended;
    }

    private function mergeScopes(array $scope, array $extendedScope): array
    {
        if (isset($scope[ScopePreset::PATHS])) {
            $extendedScope[ScopePreset::PATHS] = isset($extendedScope[ScopePreset::PATHS])
                ? array_unique(array_merge($scope[ScopePreset::PATHS], $extendedScope[ScopePreset::PATHS]))
                : $scope[ScopePreset::PATHS];
        }

        if (isset($scope[ScopePreset::EXCLUDES])) {
            $extendedScope[ScopePreset::EXCLUDES] = isset($extendedScope[ScopePreset::EXCLUDES])
                ? array_unique(array_merge($scope[ScopePreset::EXCLUDES], $extendedScope[ScopePreset::EXCLUDES]))
                : $scope[ScopePreset::EXCLUDES];
        }

        if (isset($scope[ScopePreset::RULES])) {
            $extendedScope[ScopePreset::RULES] = isset($extendedScope[ScopePreset::RULES])
                ? $this->mergeRules($scope[ScopePreset::RULES], $extendedScope[ScopePreset::RULES])
                : $scope[ScopePreset::RULES];
        }

        return $extendedScope;
    }

    private function mergeRules(array $rules, array $extendedRules): array
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
