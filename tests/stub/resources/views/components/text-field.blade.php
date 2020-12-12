<div>
    <div class="sm:flex items-center justify-between mb-4 sm:mb-1 {{ $class ?? null }}">
        @isset($label)
            <label for="{{ $name }}" class="block w-1/5 mb-1 sm:mb-0 mr-2">
                {{ $label }}
            </label>
        @endisset

        <input
            id="{{ $name }}"
            type="text"
            name="{{ $name }}"
            value="{{ $value ?? old($name) ?? $initialValue ?? null }}"

            {{ ($required ?? null) ? 'required' : '' }}
            {{ ($autofocus ?? null) ? 'autofocus' : '' }}

            class="block w-full outline-none p-2 rounded-sm bg-gray-100 border-gray-500 border"
        >
    </div>

    @if ($errors->has($name))
        <div class="flex justify-end">
            <span class="text-red text-sm mb-2">
                {{ $errors->first($name) }}
            </span>
        </div>
    @endif
</div>
