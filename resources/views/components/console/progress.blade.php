@props(['value' => 0, 'label' => null, 'detail' => null])

<div {{ $attributes->class('console-progress') }}>
    @if ($label || $detail)<div class="console-progress__meta"><span>{{ $label }}</span><span>{{ $detail }}</span></div>@endif
    <div class="console-progress__track"><span style="width: {{ min(100, max(0, $value)) }}%"></span></div>
</div>
