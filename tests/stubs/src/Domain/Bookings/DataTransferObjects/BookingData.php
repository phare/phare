<?php

namespace Stub\Domain\Bookings\DataTransferObjects;

use Stub\App\Admin\Bookings\Requests\BookingFormRequest;
use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Units\Models\Unit;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\Period\Period;

class BookingData extends DataTransferObject
{
    public ?string $name;

    public Unit $unit;

    public Client $client;

    public Period $period;

    public static function fromRequest(BookingFormRequest $request): BookingData
    {
        return new self([
            'name' => $request->input('name'),
            'unit' => Unit::findOrFail($request->input('unit_id')),
            'client' => Client::findOrFail($request->input('client_id')),
            'period' => Period::make(
                $request->input('starts_at'),
                $request->input('ends_at'),
            ),
        ]);
    }
}
