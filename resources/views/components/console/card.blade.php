@props(['padding' => 'md'])

<section {{ $attributes->class(['console-card', "console-card--{$padding}"]) }}>
    {{ $slot }}
</section>
