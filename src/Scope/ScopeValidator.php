<?php

namespace Phare\Scope;

use Phare\Exception\GuidelineConfigurationException;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\Rule;

class ScopeValidator
{
    private static array $authorizedKeys = [
        ScopePreset::PATHS,
        ScopePreset::EXCLUDES,
        ScopePreset::RULES,
    ];

    /**
     * @throws GuidelineConfigurationException
     */
    public static function validate(array $values): void
    {
        $difference = array_diff(array_keys($values), self::$authorizedKeys);

        if (!empty($difference)) {
            throw new GuidelineConfigurationException(
                'A scope array can only contain the following keys: '
                . implode(', ', self::$authorizedKeys) . '. Found: ' . array_keys($values)
            );
        }

        if (isset($values[ScopePreset::PATHS])) {
           self::validateArrayOfPaths($values[ScopePreset::PATHS]);
        }

        if (isset($values[ScopePreset::EXCLUDES])) {
           self::validateArrayOfPaths($values[ScopePreset::EXCLUDES]);
        }

        if (isset($values[ScopePreset::RULES])) {
           self::validateArrayOfRules($values[ScopePreset::RULES]);
        }
    }

    /**
     * @throws GuidelineConfigurationException
     */
    private static function validateArrayOfPaths($paths): void
    {
        if (!is_array($paths) && $paths !== null) {
            throw new GuidelineConfigurationException(
                'The "paths" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($paths)
            );
        }

        foreach ($paths as $path) {
            if (!is_string($path)) {
                throw new GuidelineConfigurationException(
                    'The "paths" property of your guideline file should be an array of strings.'
                    . 'Found: ' . gettype($paths)
                );
            }
        }
    }

    /**
     * @throws GuidelineConfigurationException
     */
    private static function validateArrayOfRules($rules): void
    {
        if (!is_array($rules) && $rules !== null) {
            throw new GuidelineConfigurationException(
                'The "rules" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($rules)
            );
        }

        foreach ($rules as $rule) {
            if (!($rule instanceof Rule)) {
                throw new GuidelineConfigurationException(
                    'The "rules" property of your guideline file should be an array of Rule classes.'
                    . 'Found: ' . gettype($rules)
                );
            }
        }
    }
}
