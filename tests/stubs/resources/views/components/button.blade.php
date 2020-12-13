<div>
    @isset($link)
        <a
            href="{{ $link }}"
            class="btn {{$class ?? null}}"
        >
            {{ $slot }}
        </a>
    @else
        <input
            type="submit"
            value="{{ $slot }}"
            class="btn {{ $class ?? null }}"
        />
    @endisset
</div>
