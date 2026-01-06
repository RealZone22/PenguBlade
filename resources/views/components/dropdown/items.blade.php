@props([
    'position' => 'bottom',
])

@php
    $positionClasses = match ($position) {
        'top' => 'bottom-full left-0 mb-1',
        'left' => 'right-full top-0 mr-1',
        'right' => 'left-full top-0 ml-1',
        default => 'top-full left-0 mt-1', // bottom
    };
@endphp

<div x-cloak
     x-show="isOpen || openedWithKeyboard"
     x-transition
     x-trap="openedWithKeyboard"
     x-on:click.outside="isOpen = false, openedWithKeyboard = false"
     x-on:keydown.down.prevent="$focus.wrap().next()"
     x-on:keydown.up.prevent="$focus.wrap().previous()"
     {{ $attributes->twMerge("absolute z-50 min-w-full w-max flex flex-col overflow-hidden rounded-radius border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt $positionClasses") }}
     role="menu">
    {{ $slot }}
</div>
