<?php

namespace Stub\App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public string $action;

    public string $method;

    public string $class;

    public function __construct(
        string $action,
        string $method = 'post',
        string $class = ''
    ) {
        $this->action = $action;
        $this->method = $method;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.form');
    }
}
