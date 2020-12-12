<?php

namespace Stub\App\View\Components;

use Illuminate\View\Component;

class TextField extends Component
{
    public string $name;

    public ?string $value;

    public ?string $label;

    public function __construct(
        string $name,
        ?string $label = null,
        ?string $initialValue = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = old($name, $initialValue);
    }

    public function render()
    {
        return view('components.text-field');
    }
}
