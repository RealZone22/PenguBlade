<div x-show="modalIsOpen"
     x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
     x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
    {{ $attributes->twMerge('flex flex-col gap-4 overflow-hidden rounded-radius border border-outline bg-surface text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark') }}>
    {{ $slot }}
</div>
