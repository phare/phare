<?php

namespace Stub\Support\TestFactories;

abstract class Factory
{
    abstract public function create(array $parameters = []);

    /**
     * @return static
     */
    public static function new(): self
    {
        return new static();
    }

    /**
     * @param int $times
     *
     * @return \Tests\Factories\FactoryCollection|static
     */
    public static function times(int $times): FactoryCollection
    {
        return new FactoryCollection(static::class, $times);
    }
}
