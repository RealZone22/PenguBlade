<div
    x-data="{ isExpanded: false, uuid: Math.random().toString(20).substring(2, 20) }" {{ $attributes->twMerge('text-neutral-600 dark:text-neutral-300') }}>
    {{ $slot }}
</div>
