<?php

namespace Stub\App\Admin\Bookings\Controllers;

use Stub\App\Admin\Bookings\Queries\BookingIndexQuery;
use Stub\App\Admin\Bookings\Requests\BookingFormRequest;
use Stub\App\Admin\Bookings\ViewModels\BookingFormViewModel;
use Stub\Domain\Bookings\Actions\CreateBookingAction;
use Stub\Domain\Bookings\Actions\UpdateBookingAction;
use Stub\Domain\Bookings\DataTransferObjects\BookingData;
use Stub\Domain\Bookings\Models\Booking;

class BookingsController
{
    public function index(BookingIndexQuery $query)
    {
        $bookings = $query->paginate();

        return view('admin.bookings.index', [
            'bookings' => $bookings,
        ]);
    }

    public function create()
    {
        return (new BookingFormViewModel())
            ->view('admin.bookings.form');
    }

    public function store(
        BookingFormRequest $request,
        CreateBookingAction $createBookingAction
    ) {
        $bookingData = BookingData::fromRequest($request);

        $booking = $createBookingAction($bookingData);

        flash()->success("Booking created");

        return redirect()->action([self::class, 'edit'], $booking->id);
    }

    public function edit(Booking $booking)
    {
        return (new BookingFormViewModel($booking))
            ->view('admin.bookings.form');
    }

    public function update(
        Booking $booking,
        BookingFormRequest $request,
        UpdateBookingAction $updateBookingAction
    ) {
        $bookingData = BookingData::fromRequest($request);

        $updateBookingAction($booking, $bookingData);

        flash()->success("Booking saved");

        return redirect()->action([self::class, 'edit'], $booking->id);
    }
}
