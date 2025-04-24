@props([
    'divider' => true
])

<div {{ $attributes->twMerge('font-bold text-xl') }}>
    {{ $slot }}
</div>

@if($divider)
    <x-divider/>
@endif
