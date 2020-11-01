<?php

namespace NicolasBeauvais\Warden\Preset;

use NicolasBeauvais\Warden\Kernel;

class Guideline
{
    public const EXTENDS = 'extends';

    public const SCOPES = 'scopes';

    private static function load(string $name): array
    {
        return require Kernel::getSourceRoot() . "/Guideline/preset/$name.php";
    }

    public static function default(): array
    {
        return self::load('default');
    }

    public static function laravel(): array
    {
        return self::load('laravel');
    }

    public static function symfony(): array
    {
        return self::load('symfony');
    }
}
