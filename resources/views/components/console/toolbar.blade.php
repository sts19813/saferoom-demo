<div {{ $attributes->class('console-toolbar') }}>
    <div class="console-toolbar__main">{{ $slot }}</div>
    @isset($actions)<div class="console-toolbar__actions">{{ $actions }}</div>@endisset
</div>
