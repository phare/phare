<?php

namespace Stub\Domain\Bookings\Observers;

use Stub\Domain\Bookings\Models\Booking;

class BookingObserver
{
    public function saving(Booking $booking): void
    {
        if ($booking->name === null) {
            $booking->name = "Booking for {$booking->unit->name} ({$booking->period->format()})";
        }
    }
}
