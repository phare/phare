<?php

namespace Stub\App\Admin\Bookings\ViewModels;

use Stub\Domain\Bookings\Models\Booking;
use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Units\Models\Unit;
use Spatie\ViewModels\ViewModel;

class BookingFormViewModel extends ViewModel
{
    public Booking $booking;

    public function __construct(?Booking $booking = null)
    {
        $this->booking = $booking ?? new Booking();
    }

    public function isCreating(): bool
    {
        return $this->booking->id === null;
    }

    public function unitOptions(): array
    {
        return Unit::get()
            ->mapWithKeys(fn(Unit $unit) => [$unit->id => $unit->name])
            ->toArray();
    }

    public function clientOptions(): array
    {
        return Client::get()
            ->mapWithKeys(fn(Client $client) => [$client->id => $client->name])
            ->toArray();
    }

    public function title(Booking $booking): string
    {
        if ($booking->id === null) {
            return 'New Booking';
        }

        return $booking->name;
    }
}
