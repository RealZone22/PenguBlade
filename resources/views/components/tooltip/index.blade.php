@props([
    'tooltip' => null,
    'position' => 'top'
])

<?php
$positionClass = match ($position) {
    'top' => '-top-9 left-1/2 -translate-x-1/2',
    'bottom' => '-bottom-9 left-1/2 -translate-x-1/2',
    'left' => 'top-1/2 right-full -translate-y-1/2 mr-2',
    'right' => 'top-1/2 left-full -translate-y-1/2 ml-2',
};
?>

<div class="relative w-fit">
    <div class="peer">
        {{ $slot }}
    </div>
    <div
        {{ $attributes->twMerge('absolute whitespace-nowrap z-10 rounded-sm bg-surface-dark px-2 py-1 text-center text-sm text-on-surface-dark-strong opacity-0 transition-all ease-out peer-hover:opacity-100 peer-focus:opacity-100 dark:bg-surface dark:text-on-surface-strong ' . $positionClass) }}
        role="tooltip">
        {{ $tooltip }}
    </div>
</div>
