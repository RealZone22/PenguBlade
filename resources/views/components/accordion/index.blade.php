<div x-data="{ selectedAccordionItem: '' }"
    {{ $attributes->twMerge('w-full overflow-hidden rounded-md bg-neutral-50/40 text-neutral-600 dark:bg-neutral-900/50 dark:text-neutral-300') }}>
    {{ $slot }}
</div>
