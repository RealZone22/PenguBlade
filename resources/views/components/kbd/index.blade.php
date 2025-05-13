@props([
    'size' => 'sm',
    'tooltip' => null,
])

<?php

$sizeClass = match ($size) {
    'xs' => 'text-xs',
    'md' => 'text-base',
    'lg' => 'text-lg',
    default => 'text-sm',
};

?>

<kbd @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
    {{ $attributes->twMerge('inline-block size-min whitespace-nowrap rounded-md border border-outline bg-surface-alt px-2 py-1 font-mono font-semibold text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark ' . $sizeClass) }}>
    {{ $slot }}
</kbd>
