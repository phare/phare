<?php

namespace NicolasBeauvais\Warden\Scope;

use NicolasBeauvais\Warden\Preset\Scope as ScopePreset;

class ScopeFactory
{
    public static function make(string $name, array $values): Scope
    {
       return new Scope(
           $name,
           $values[ScopePreset::PATHS] ?? ['*'],
           $values[ScopePreset::EXCLUDES] ?? [],
           $values[ScopePreset::RULES] ?? []
       );
    }
}
