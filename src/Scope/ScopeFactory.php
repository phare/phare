<?php

namespace NicolasBeauvais\Warden\Scope;

use NicolasBeauvais\Warden\Preset\Scope as ScopePreset;

class ScopeFactory
{
    public static function make(array $values): Scope
    {
       return new Scope(
           $values[ScopePreset::PATHS] ?? [],
           $values[ScopePreset::EXCLUDES] ?? [],
           $values[ScopePreset::RULES] ?? []
       );
    }
}
