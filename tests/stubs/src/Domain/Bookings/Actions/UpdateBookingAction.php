<?php

namespace Stub\Domain\Bookings\Actions;

use Stub\Domain\Bookings\DataTransferObjects\BookingData;
use Stub\Domain\Bookings\Models\Booking;

class UpdateBookingAction
{
    public function __invoke(Booking $booking, BookingData $bookingData): Booking
    {
        $booking->fill([
            'name' => $bookingData->name,
            'unit_id' => $bookingData->unit->id,
            'client_id' => $bookingData->client->id,
            'starts_at' => $bookingData->period->getStart(),
            'ends_at' => $bookingData->period->getEnd(),
        ])->save();

        return $booking->refresh();
    }
}
