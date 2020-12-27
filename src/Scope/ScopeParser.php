<?php

namespace Phare\Scope;

use Phare\Kernel;
use Phare\Preset\Scope as ScopePreset;

class ScopeParser
{
    public function parse(array $values): array
    {
        if (empty($values[ScopePreset::PATHS])) {
            $values[ScopePreset::PATHS] = [Kernel::getProjectRoot()];
        }

        if (empty($values[ScopePreset::EXCLUDES])) {
            $values[ScopePreset::EXCLUDES] = [];
        }

        if (empty($values[ScopePreset::RULES])) {
            $values[ScopePreset::RULES] = [];
        }

        $values[ScopePreset::PATHS] = $this->makePathsAbsolute($values[ScopePreset::PATHS]);

        return $values;
    }

    private function makePathsAbsolute(array $paths): array
    {
        foreach ($paths as &$path) {
            if (strpos($path, DIRECTORY_SEPARATOR) !== 0) {
                $path = Kernel::getProjectRoot() . $path;
            }

            $path = rtrim($path, '/') . '/';
        } unset($path);

        return $paths;
    }
}
