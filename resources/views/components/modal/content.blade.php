<div x-show="modalIsOpen"
     x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
     x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
    {{ $attributes->twMerge('flex max-w-lg flex-col gap-4 overflow-hidden rounded-md bg-white text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300') }}>
    {{ $slot }}
</div>
