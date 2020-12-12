<?php

namespace Phare\Tests\Traits;

use Phare\Scope\Scope;
use Phare\Scope\ScopeFactory;
use Phare\Preset\Scope as ScopePreset;

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
