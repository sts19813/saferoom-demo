@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button'])

<button type="{{ $type }}" {{ $attributes->class([
    'console-button',
    "console-button--{$variant}",
    "console-button--{$size}",
]) }}>
    {{ $slot }}
</button>
