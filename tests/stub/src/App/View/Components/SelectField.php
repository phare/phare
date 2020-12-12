<?php

namespace Stub\App\View\Components;

use Illuminate\View\Component;

class SelectField extends Component
{
    public string $name;

    public array $options;

    public ?string $value;

    public ?string $label;

    public function __construct(
        string $name,
        array $options,
        ?string $initialValue = null,
        ?string $label = null
    ) {
        $this->name = $name;
        $this->options = $options;
        $this->label = $label;
        $this->value = old($name, $initialValue);
    }

    public function render()
    {
        return view('components.select-field');
    }
}
