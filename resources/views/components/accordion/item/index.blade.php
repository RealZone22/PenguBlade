@props([
    'uuid' => str()->uuid(),
])

<div x-data="{ uuid: '{{ $uuid }}' ? '{{ $uuid }}' : @entangle($attributes->wire('model')) }" {{ $attributes }}>
    {{ $slot }}
</div>
