<?php

namespace Phare\Scope;

use Phare\Exception\ScopeConfigurationException;
use Phare\Preset\Scope as ScopePreset;
use Phare\Rule\Rule;

class ScopeValidator
{
    private array $authorizedKeys = [
        ScopePreset::PATHS,
        ScopePreset::EXCLUDES,
        ScopePreset::RULES,
    ];

    /**
     * @throws ScopeConfigurationException
     */
    public function validate(array $values): void
    {
        $difference = array_diff(array_keys($values), $this->authorizedKeys);

        if (!empty($difference)) {
            throw new ScopeConfigurationException(
                'A scope array can only contain the following keys: '
                . implode(', ', $this->authorizedKeys) . '. Found: ' . implode(', ', array_keys($values))
            );
        }

        if (isset($values[ScopePreset::PATHS])) {
            $this->validateArrayOfPaths($values[ScopePreset::PATHS]);
        }

        if (isset($values[ScopePreset::EXCLUDES])) {
            $this->validateArrayOfPaths($values[ScopePreset::EXCLUDES]);
        }

        if (isset($values[ScopePreset::RULES])) {
            $this->validateArrayOfRules($values[ScopePreset::RULES]);
        }
    }

    /**
     * @param mixed $paths
     *
     * @throws ScopeConfigurationException
     */
    private function validateArrayOfPaths($paths): void
    {
        if (!is_array($paths)) {
            throw new ScopeConfigurationException(
                'The "paths" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($paths)
            );
        }

        foreach ($paths as $path) {
            if (!is_string($path)) {
                throw new ScopeConfigurationException(
                    'The "paths" property of your guideline file should be an array of strings.'
                    . 'Found: ' . gettype($paths)
                );
            }
        }
    }

    /**
     * @param mixed $rules
     *
     * @throws ScopeConfigurationException
     */
    private function validateArrayOfRules($rules): void
    {
        if (!is_array($rules)) {
            throw new ScopeConfigurationException(
                'The "rules" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($rules)
            );
        }

        foreach ($rules as $rule) {
            if (!($rule instanceof Rule)) {
                throw new ScopeConfigurationException(
                    'The "rules" property of your guideline file should be an array of Rule classes.'
                    . 'Found: ' . gettype($rules)
                );
            }
        }
    }
}
