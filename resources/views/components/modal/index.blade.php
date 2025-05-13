@props([
    'defaultOpen' => false,
    'trigger' => null,
])

<div
    x-data="{modalIsOpen: @entangle($attributes->wire('model')) ? @entangle($attributes->wire('model')) : {{ $defaultOpen ? 'true' : 'false' }}}">
    @if($trigger)
        {{ $trigger }}
    @endif
    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
         x-on:keydown.esc.window="modalIsOpen = false" x-on:click.self="modalIsOpen = false"
         {{ $attributes->twMerge('fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8') }}
         role="dialog" aria-modal="true">
        {{ $slot }}
    </div>
</div>
