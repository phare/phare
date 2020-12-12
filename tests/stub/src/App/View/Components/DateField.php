<?php

namespace Stub\App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class DateField extends Component
{
    public string $name;

    public ?string $value;

    public ?string $label;

    public function __construct(
        string $name,
        ?string $label = null,
        $initialValue = null
    ) {
        $this->name = $name;
        $this->label = $label;

        $initialValue = Carbon::make($initialValue) ?? now();

        $this->value = old($name, $initialValue->toDateString());
    }

    public function render()
    {
        return view('components.date-field');
    }
}
