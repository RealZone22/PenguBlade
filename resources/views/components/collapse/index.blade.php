@props([
    'uuid' => 'pengublade-collapse-' . str()->uuid(),
])

<div x-data="{ isExpanded: false, uuid: '{{ $uuid }}' }" {{ $attributes->twMerge('') }}>
    {{ $slot }}
</div>
