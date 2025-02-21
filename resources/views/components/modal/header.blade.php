@props([
    'showCloseButton' => true,
    'useWireModal' => true,
    'closeIcon' => 'icon-x'
])

<div {{ $attributes->twMerge('flex items-center justify-between bg-neutral-50/60 p-4 dark:bg-neutral-950/20') }}>
    <h3 class="font-semibold tracking-wide text-neutral-900 dark:text-white">
        {{ $slot }}
    </h3>
    @if($showCloseButton)
        <button @if($useWireModal) wire:click="closeModal" @else @click="modalIsOpen = false" @endif
        aria-label="close modal" class="cursor-pointer">
            <i class="{{ $closeIcon }}"></i>
        </button>
    @endif
</div>
