@props(['title' => 'No hay resultados', 'description' => null])

<div {{ $attributes->class('console-empty') }}>
    <div class="console-empty__icon">{{ $icon ?? '⌁' }}</div>
    <h3>{{ $title }}</h3>
    @if ($description)<p>{{ $description }}</p>@endif
    @isset($action)<div class="console-empty__action">{{ $action }}</div>@endisset
</div>
