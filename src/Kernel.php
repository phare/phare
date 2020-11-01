<?php

namespace NicolasBeauvais\Warden;

use NicolasBeauvais\Warden\Console\Application;

class Kernel
{
    public const VERSION = '0.0.1';

    public const REQUIRED_PHP_VERSION = '7.4.0';

    public static function validPHPVersion(): bool
    {
        return version_compare(self::REQUIRED_PHP_VERSION, PHP_VERSION, '<=');
    }

    public static function bootstrap(): void
    {
        (new \NunoMaduro\Collision\Provider)->register();

        (new Application)->run();
    }

    public static function getProjectRoot(): string
    {
        return getcwd();
    }

    public static function getSourceRoot(): string
    {
        return __DIR__;
    }
}
