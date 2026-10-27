@props(['label', 'value', 'trend' => null, 'tone' => 'neutral'])

<x-console.card {{ $attributes }}>
    <p class="console-metric__label">{{ $label }}</p>
    <strong class="console-metric__value">{{ $value }}</strong>
    @if ($trend)<p class="console-metric__trend console-metric__trend--{{ $tone }}">{{ $trend }}</p>@endif
</x-console.card>
