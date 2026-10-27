@props(['title' => null, 'description' => null])

<section {{ $attributes->class('console-panel') }}>
    @if ($title || $description || isset($actions))
        <header class="console-panel__header">
            <div>
                @if ($title)<h2 class="console-panel__title">{{ $title }}</h2>@endif
                @if ($description)<p class="console-panel__description">{{ $description }}</p>@endif
            </div>
            @isset($actions)<div class="console-panel__actions">{{ $actions }}</div>@endisset
        </header>
    @endif
    <div class="console-panel__body">{{ $slot }}</div>
</section>
