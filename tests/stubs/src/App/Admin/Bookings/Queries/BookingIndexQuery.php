<?php

namespace Stub\App\Admin\Bookings\Queries;

use Stub\Domain\Bookings\Models\Booking;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Stub\Support\Filters\FuzzyFilter;

class BookingIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Booking::query()
            ->join('clients', 'clients.id', '=', 'bookings.client_id')
            ->join('units', 'units.id', '=', 'bookings.unit_id');

        parent::__construct($query, $request);

        $this->allowedSorts([
            AllowedSort::field('period', 'starts_at'),
            AllowedSort::field('client', 'clients.name'),
            AllowedSort::field('unit', 'units.name'),
        ]);

        $this->allowedFilters([
            AllowedFilter::custom('search', new FuzzyFilter(
                'units.name',
                'clients.name',
            ))
        ]);
    }
}
