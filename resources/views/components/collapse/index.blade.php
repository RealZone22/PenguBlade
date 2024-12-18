@props([
    'uuid' => 'pengublade-collapse-' . str()->uuid(),
])

<div
    x-data="{ isExpanded: false, uuid: '{{ $uuid }}' }" {{ $attributes->twMerge('text-neutral-600 dark:text-neutral-300') }}>
    {{ $slot }}
</div>
