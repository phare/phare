<?php

namespace Stub\App\View\Components;

use Illuminate\Http\Request;
use Illuminate\View\Component;

class SearchField extends Component
{
    public string $currentUrl;

    public ?string $currentSearchQuery;

    public function __construct()
    {
        /** @var \Illuminate\Http\Request $request */
        $request = app()->get(Request::class);

        $this->currentUrl = $request->url();
        $this->currentSearchQuery = $request->get('filter')['search'] ?? null;
    }

    public function render()
    {
        return view('components.search-field');
    }
}
