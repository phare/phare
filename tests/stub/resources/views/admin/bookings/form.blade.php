@php
    /** @var \Domain\Bookings\Models\Booking $booking */
@endphp

@component('admin.app', [
    'title' => $title($booking),
])
    <x-form
        action="{{ $isCreating
            ? action([\App\Admin\Bookings\Controllers\BookingsController::class, 'store'])
            : action([\App\Admin\Bookings\Controllers\BookingsController::class, 'update'], $booking->id)
        }}"
        class="w-2/5 p-2"
    >
        @if(!$isCreating)
            <x-text-field
                name="name"
                label="Name"
                :initial-value="$booking->name"
            ></x-text-field>
        @endif

        <x-select-field
            name="unit_id"
            label="Unit"
            :options="$unitOptions"
            :initial-value="$booking->unit_id"
        ></x-select-field>

        <x-select-field
            name="client_id"
            label="Client"
            :options="$clientOptions"
            :initial-value="$booking->client_id"
        ></x-select-field>

        <x-date-field
            name="starts_at"
            label="Starts at"
            :initial-value="$booking->starts_at ?? now()"
        ></x-date-field>

        <x-date-field
            name="ends_at"
            label="Ends at"
            :initial-value="$booking->ends_at ?? now()->addDays(5)"
        ></x-date-field>

        <x-controls>
            <x-button>Save</x-button>

            <a class="ml-2" href="{{ action([\App\Admin\Bookings\Controllers\BookingsController::class, 'index']) }}">Back</a>
        </x-controls>
    </x-form>
@endcomponent
