<?php

namespace Stub\Domain\Bookings\Actions;

use Stub\Domain\Bookings\DataTransferObjects\BookingData;
use Stub\Domain\Bookings\Models\Booking;

class CreateBookingAction
{
    public function __invoke(BookingData $bookingData): Booking
    {
        $booking = Booking::create([
            'name' => $bookingData->name,
            'unit_id' => $bookingData->unit->id,
            'client_id' => $bookingData->client->id,
            'starts_at' => $bookingData->period->getStart(),
            'ends_at' => $bookingData->period->getEnd(),
        ]);

        return $booking;
    }
}
