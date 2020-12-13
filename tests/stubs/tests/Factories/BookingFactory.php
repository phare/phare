<?php

namespace Tests\Factories;

use Carbon\Carbon;
use Domain\Bookings\Models\Booking;
use Domain\Units\Models\Unit;
use Spatie\Period\Period;
use Support\TestFactories\Factory;

class BookingFactory extends Factory
{
    private ?Unit $unit = null;

    private ?Period $period = null;

    public static function new(): BookingFactory
    {
        return new self();
    }

    public function create(array $extra = []): Booking
    {
        $startsAt = optional($this->period)->getStart()
            ?? faker()->dateTimeBetween('now', '+1 year');

        $endsAt = optional($this->period)->getEnd()
            ?? Carbon::make($startsAt)->addDays(faker()->numberBetween(10, 100));

        return Booking::create(
            $extra + [
                'starts_at' => $startsAt,
                'ends_at' => $endsAt,
                'unit_id' => $this->unit->id ?? UnitFactory::new()->create()->id,
                'client_id' => ClientFactory::new()->create()->id,
            ]
        );
    }

    public function withUnit(Unit $unit): self
    {
        $clone = clone $this;

        $clone->unit = $unit;

        return $clone;
    }

    public function withPeriod(Period $period): self
    {
        $clone = clone $this;

        $clone->period = $period;

        return $clone;
    }
}
