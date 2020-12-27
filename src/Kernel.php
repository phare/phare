<?php

namespace Phare;

use League\Container\Container;
use League\Container\ReflectionContainer;
use NunoMaduro\Collision\Provider;
use Phare\Console\Application;

class Kernel
{
    public const VERSION = '0.0.1';

    public const REQUIRED_PHP_VERSION = '7.0.0';

    protected static bool $bootstrapped = false;

    public static Container $container;

    public static function validPHPVersion(): bool
    {
        return version_compare(self::REQUIRED_PHP_VERSION, PHP_VERSION, '<=');
    }

    public static function bootstrap(): void
    {
        if (self::$bootstrapped) {
            return;
        }

        self::registerCollision();

        self::$bootstrapped = true;

         $application = new Application(self::container());

        $application->run();
    }

    public static function getProjectRoot(): string
    {
        return getcwd() . DIRECTORY_SEPARATOR;
    }

    public static function getSourceRoot(): string
    {
        return __DIR__;
    }

    public static function container(): Container
    {
        if (isset(self::$container)) {
            return self::$container;
        }

        $container = new Container();

        $container->delegate(new ReflectionContainer());

        self::$container = $container;

        return $container;
    }

    private static function registerCollision(): void
    {
        $collisionProvider = new Provider();

        $collisionProvider->register();
    }
}
