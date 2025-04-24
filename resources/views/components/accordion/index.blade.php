@props([
    'selectedAccordionItem' => null,
])

<div
    x-data="{ selectedAccordionItem: '{{ $selectedAccordionItem }}' ? '{{ $selectedAccordionItem }}' : @entangle($attributes->wire('model')) }"
    {{ $attributes->twMerge('w-full divide-y divide-outline overflow-hidden rounded-md border border-outline bg-surface-alt/40 text-on-surface dark:divide-outline-dark dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark') }}>
    {{ $slot }}
</div>
