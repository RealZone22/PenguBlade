@props([
    'uuid' => 'pengublade-accordion-item-' . str()->uuid(),
])

<div x-data="{ uuid: '{{ $uuid }}' }" {{ $attributes->twMerge('') }}>
    {{ $slot }}
</div>
