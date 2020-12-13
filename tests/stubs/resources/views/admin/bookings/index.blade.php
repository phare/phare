@php
/** @var \Domain\Bookings\Models\Booking[] $bookings */
@endphp

@component('admin.app', [
    'title' => 'Bookings',
])
    <div class="p-2 pt-0">
        <x-search-field></x-search-field>
    </div>

    <table class="table-auto w-screen mt-4">
        <thead>
            <tr class="bg-gray-300">
                <th class="text-left py-2 px-2">
                    <x-sort-link name="unit">
                        Unit
                    </x-sort-link>
                </th>
                <th class="text-left py-2">
                    <x-sort-link name="client">
                        Client
                    </x-sort-link>
                </th>
                <th class="text-left py-2">
                    <x-sort-link name="period">
                        Period
                    </x-sort-link>
                </th>
            </tr>
        </thead>

        @foreach($bookings as $booking)
            <tr>
                <td class="px-2 py-1">
                    <a href="{{ action([\App\Admin\Bookings\Controllers\BookingsController::class, 'edit'], $booking->id) }}" class="link">
                        {{ $booking->unit->name }}
                    </a>
                </td>

                <td class="py-1">
                    {{ $booking->client->name }}
                </td>

                <td class="py-1">
                    {{ $booking->period->format() }}
                </td>
            </tr>
        @endforeach
    </table>

    <x-controls>
        <x-button :link="action([\App\Admin\Bookings\Controllers\BookingsController::class, 'create'])">
            New booking
        </x-button>
    </x-controls>
@endcomponent
