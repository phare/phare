<?php

namespace Stub\App\Admin\Bookings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'unit_id' => ['required'],
            'client_id' => ['required'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
        ];
    }
}
