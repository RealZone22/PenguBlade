@props([
    'selectedTab' => null,
])

<div x-data="{ selectedTab: '{{ $selectedTab }}' ? '{{ $selectedTab }}' : @entangle($attributes->wire('model')) }">
    <div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()"
         {{ $attributes->twMerge('flex gap-2 overflow-x-auto border-b border-outline dark:border-outline-dark') }} role="tablist"
         aria-label="tab options">
        {{ $slot }}
    </div>
</div>
