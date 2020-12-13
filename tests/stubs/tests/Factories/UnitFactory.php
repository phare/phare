<?php

namespace Tests\Factories;

use Domain\Units\Models\Unit;
use Support\TestFactories\Factory;

class UnitFactory extends Factory
{
    private ?BookingFactory $bookingFactory = null;

    private bool $active = true;

    private static int $currentNumber = 1;

    public static function new(): UnitFactory
    {
        return new self();
    }

    public function create(array $extra = []): Unit
    {
        $unit = Unit::create(
            $extra + [
                'name' => (function () {
                    $currentNumber = str_pad(self::$currentNumber, 3, '0', STR_PAD_LEFT);

                    $clientNumber = "Unit {$currentNumber}";

                    self::$currentNumber++;

                    return $clientNumber;
                })(),
                'type' => 'Type A',
                'active' => $this->active,
            ]
        );

        if ($this->bookingFactory) {
            $this->bookingFactory
                ->withUnit($unit)
                ->create();
        }

        return $unit->refresh();
    }

    public function withBookingFactory(BookingFactory $bookingFactory): self
    {
        $clone = clone $this;

        $clone->bookingFactory = $bookingFactory;

        return $clone;
    }

    public function active(): self
    {
        $clone = clone $this;

        $clone->active = true;

        return $clone;
    }

    public function inactive(): self
    {
        $clone = clone $this;

        $clone->active = false;

        return $clone;
    }
}
