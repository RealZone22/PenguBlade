@props([
    'size' => 'sm'
])

<?php

$sizeClass = match ($size) {
    'xs' => 'text-xs',
    'md' => 'text-base',
    'lg' => 'text-lg',
    default => 'text-sm',
};

?>

<kbd
    {{ $attributes->twMerge('inline-block size-min whitespace-nowrap rounded-md border border-outline bg-surface-alt px-2 py-1 font-mono font-semibold text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark ' . $sizeClass) }}>
    {{ $slot }}
</kbd>
