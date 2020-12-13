<?php

namespace Stub\Support\TestFactories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class FactoryCollection extends Factory
{
    private array $factories;

    /**
     * @param string|\Stub\Support\TestFactories\Factory $factoryClass
     * @param int $times
     */
    public function __construct(string $factoryClass, int $times)
    {
        $this->factories = array_fill(
            0,
            $times,
            call_user_func($factoryClass . '::new')
        );
    }

    public function __call($name, $arguments)
    {
        foreach ($this->factories as $key => $factory) {
            $result = call_user_func_array([$factory, $name], $arguments);

            if (Str::startsWith($name, 'with')) {
                $this->factories[$key] = $result;
            }
        }

        return $this;
    }

    public function create(array $parameters = []): Collection
    {
        $output = new Collection();

        foreach ($this->factories as $key => $factory) {
            $output[] = call_user_func_array([$factory, 'create'], $parameters);
        }

        return $output;
    }

    public function toArray(): void
    {
    }
}
