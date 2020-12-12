<?php

namespace Phare;

use JetBrains\PhpStorm\Pure;
use Phare\Console\Application;

class Kernel
{
    public const VERSION = '0.0.1';

    public const REQUIRED_PHP_VERSION = '7.0.0';

    public static function validPHPVersion(): bool
    {
        return version_compare(self::REQUIRED_PHP_VERSION, PHP_VERSION, '<=');
    }

    public static function bootstrap(): void
    {
        (new \NunoMaduro\Collision\Provider)->register();

        (new Application)->run();
    }

    #[Pure]
    public static function getProjectRoot(): string
    {
        return getcwd();
    }

    #[Pure]
    public static function getSourceRoot(): string
    {
        return __DIR__;
    }
}
