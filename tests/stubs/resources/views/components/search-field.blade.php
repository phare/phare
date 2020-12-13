<div>
    <form
        action="{{ $currentUrl }}"
        method="GET"
        class="md:flex mt-4"
    >
        <input
            type="text"
            name="filter[search]"
            value="{{ $currentSearchQuery }}"
            class="bg-gray-100 p-2"
        />

        <div>
            <x-button>Search</x-button>

            @if($currentSearchQuery)
                <a href="{{ $currentUrl }}" class="ml-2 link">
                    {{ __('Clear search') }}
                </a>
            @endif
        </div>
    </form>

</div>
