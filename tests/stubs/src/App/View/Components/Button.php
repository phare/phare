<?php

namespace Stub\App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public ?string $link;

    public function __construct(?string $link = null)
    {
        $this->link = $link;
    }

    public function render()
    {
        return view('components.button');
    }
}
