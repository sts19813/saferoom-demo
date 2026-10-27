@props(['tone' => 'neutral'])

<span {{ $attributes->class(['console-badge', "console-badge--{$tone}"]) }}>{{ $slot }}</span>
