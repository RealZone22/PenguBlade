@props([
    'showCloseButton' => true,
    'useWireModal' => true,
    'closeIcon' => 'icon-x'
])

<div {{ $attributes->twMerge('flex items-center justify-between border-b border-outline bg-surface-alt/60 p-4 dark:border-outline-dark dark:bg-surface-dark/20') }}>
    <h3 class="font-semibold tracking-wide text-on-surface-strong dark:text-on-surface-dark-strong">
        {{ $slot }}
    </h3>
    @if($showCloseButton)
        <button @if($useWireModal) wire:click="closeModal" @else @click="modalIsOpen = false" @endif
        aria-label="close modal" class="cursor-pointer">
            <i class="{{ $closeIcon }}"></i>
        </button>
    @endif
</div>
