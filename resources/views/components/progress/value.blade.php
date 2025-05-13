@props([
    'value' => 20,
    'showText' => false,
    'rounded' => true,
    'color' => 'primary',
    'tooltip' => null,
])

<?php

$colorClass = match ($color) {
    'secondary' => 'bg-secondary dark:bg-secondary-dark text-on-secondary dark:text-on-secondary-dark',
    'success' => 'bg-success dark:bg-success-dark text-on-success dark:text-on-success-dark',
    'info' => 'bg-info dark:bg-info-dark text-on-info dark:text-on-info-dark',
    'warning' => 'bg-warning dark:bg-warning-dark text-on-warning dark:text-on-warning-dark',
    'danger' => 'bg-danger dark:bg-danger-dark text-on-danger dark:text-on-danger-dark',
    default => 'bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark',
};

?>

@if($showText)
    <div @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
        {{ $attributes->twMerge('h-full bg-primary text-center text-xs font-semibold leading-none ' . $colorClass . ' ' . ($rounded ? 'rounded-r-radius' : '')) }}
        x-bind:style="`width: ${calcPercentage(minVal, maxVal, {{ $value }})}%`">
        <span x-text="`${calcPercentage(minVal, maxVal, {{ $value }})}%`"></span>
    </div>
@else
    <div
        {{ $attributes->twMerge('h-full ' . $colorClass  . ' ' . ($rounded ? 'rounded-r-radius' : '')) }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif
         x-bind:style="`width: ${calcPercentage(minVal, maxVal, {{ $value }})}%`"></div>
@endif
