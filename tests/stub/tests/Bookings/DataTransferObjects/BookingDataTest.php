<?php

namespace Tests\Bookings\DataTransferObjects;

use App\Admin\Bookings\Requests\BookingFormRequest;
use App\Admin\Bookings\Requests\BookingStoreRequest;
use Domain\Bookings\DataTransferObjects\BookingData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\Factories\ClientFactory;
use Tests\Factories\UnitFactory;
use Tests\TestCase;

class BookingDataTest extends TestCase
{
    /** @test */
    public function form_booking_store_request()
    {
        $unit = UnitFactory::new()->create();

        $client = ClientFactory::new()->create();

        $dto = BookingData::fromRequest(new BookingFormRequest([
            'name' => 'test',
            'unit_id' => $unit->id,
            'client_id' => $client->id,
            'date_start' => '2020-12-01',
            'date_end' => '2020-12-05',
        ]));

        $this->assertInstanceOf(BookingData::class, $dto);
    }

    /** @test */
    public function from_booking_store_request_without_unit_fails()
    {
        $this->expectException(ModelNotFoundException::class);

        $client = ClientFactory::new()->create();

        BookingData::fromRequest(new BookingFormRequest([
            'name' => 'test',
            'client_id' => $client->id,
            'date_start' => '2020-12-01',
            'date_end' => '2020-12-05',
        ]));
    }
}
