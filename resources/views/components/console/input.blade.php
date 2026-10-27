@props(['label' => null, 'hint' => null])

<label {{ $attributes->class('console-field') }}>
    @if ($label)<span class="console-field__label">{{ $label }}</span>@endif
    {{ $slot }}
    @if ($hint)<span class="console-field__hint">{{ $hint }}</span>@endif
</label>
