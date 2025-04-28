@props([
    'open' => false,
])

<div x-data="{ isOpen: {{ $open ? 'true' : 'false' }}, openedWithKeyboard: false }"
     x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false" {{ $attributes->twMerge('relative w-fit') }}>
    {{ $slot }}
</div>
