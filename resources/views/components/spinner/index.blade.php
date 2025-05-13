@props([
    'color' => 'primary',
    'size' => 'md',
    'tooltip' => null,
])

<?php
$colorClass = match ($color) {
    'primary' => 'fill-primary dark:fill-primary-dark',
    'secondary' => 'fill-secondary dark:fill-secondary-dark',
    'info' => 'fill-info dark:fill-info',
    'success' => 'fill-success dark:fill-success',
    'warning' => 'fill-warning dark:fill-warning',
    'danger' => 'fill-danger dark:fill-danger',
};

$sizeClass = match ($size) {
    'sm' => 'size-4',
    'lg' => 'size-6',
    'xl' => 'size-7',
    default => 'size-5',
};
?>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
     @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
     aria-hidden="true" {{ $attributes->twMerge('motion-safe:animate-spin ' . $colorClass . ' ' . $sizeClass) }}>
    <path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25"/>
    <path
        d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"/>
</svg>
