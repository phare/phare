<?php

namespace Phare\Tests\Traits;

use Phare\Preset\Scope as ScopePreset;
use Phare\Scope\Scope;
use Phare\Scope\ScopeFactory;

trait CreateScopes
{
    public function makeScope(array $paths, array $rules): Scope
    {
        return ScopeFactory::make('test', [
            ScopePreset::PATHS => $paths,
            ScopePreset::RULES => $rules,
        ]);
    }
}
