@props([
    'defaultOpen' => false,
])

<div x-data="{modalIsOpen: '{{ $defaultOpen }}' ? '{{ $defaultOpen }}' : @entangle($attributes->wire('model'))}">
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
         {{ $attributes->twMerge('fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8') }}
         role="dialog" aria-modal="true">
        {{ $slot }}
    </div>
</div>
