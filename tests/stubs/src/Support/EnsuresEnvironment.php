<?php

namespace Stub\Support;

use Exception;

trait EnsuresEnvironment
{
    /**
     * @param string ...$environments
     *
     * @throws \Exception
     */
    public function ensureEnvironment(...$environments): void
    {
        if (! app()->environment($environments)) {
            throw new Exception('This command can only be run in these environments: ' . implode(' ', $environments) . '. The current environment is ' . app()->environment());
        }
    }
}
