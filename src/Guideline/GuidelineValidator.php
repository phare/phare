<?php

namespace Phare\Guideline;

use Phare\Exception\GuidelineConfigurationException;
use Phare\Preset\Guideline as GuidelinePreset;

class GuidelineValidator
{
    private array $authorizedKeys = [
        GuidelinePreset::EXTENDS,
        GuidelinePreset::SCOPES
    ];

    /**
     * @throws GuidelineConfigurationException
     */
    public function validate(array $values): bool
    {
        $difference = array_diff(array_keys($values), $this->authorizedKeys);

        if (!empty($difference)) {
            throw new GuidelineConfigurationException(
                'A guideline array can only contain the following keys: '
                . implode(', ', $this->authorizedKeys) . '. Found: ' . implode(', ', array_keys($values))
            );
        }

        if (isset($values[GuidelinePreset::EXTENDS])) {
            $this->validateExtends($values[GuidelinePreset::EXTENDS]);
        }

        if (isset($values[GuidelinePreset::SCOPES])) {
            $this->validateArrayOfScopes($values[GuidelinePreset::SCOPES]);
        }

        return true;
    }

    /**
     * @param mixed $extends
     *
     * @throws GuidelineConfigurationException
     */
    private function validateExtends($extends): void
    {
        if (!is_array($extends)) {
            throw new GuidelineConfigurationException(
                'The "extends" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($extends)
            );
        }
    }

    /**
     * @param mixed $scopes
     *
     * @throws GuidelineConfigurationException
     */
    private function validateArrayOfScopes($scopes): void
    {
        if (!is_array($scopes)) {
            throw new GuidelineConfigurationException(
                'The "scopes" property of your guideline file should be of type array or null.'
                . 'Found: ' . gettype($scopes)
            );
        }

        foreach ($scopes as $scopeName => $scope) {
            if (!is_array($scope) && $scope !== null) {
                throw new GuidelineConfigurationException(
                    'The "' . $scopeName . '" scope of your guideline file should be of type array or null.'
                    . 'Found: ' . gettype($scopes)
                );
            }
        }
    }
}
