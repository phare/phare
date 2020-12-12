<form
    method="{{ $method }}"
    action="{{ $action }}"
    class="{{ $class ?? null }}"
>
    @csrf

    {{ $slot ?? null }}
</form>
