@props([
    'placeholderColor' => null,
    'placeholderIcon' => null,
    'placeholderInitials' => null,
    'status' => null,
    'tooltip' => null,
    'size' => 'md',
])

<?php
$placeholderColorClass = match ($placeholderColor) {
    'inverse' => 'border-outline-dark bg-surface-dark-alt text-on-surface-dark/50 dark:border-outline dark:bg-surface-alt dark:text-on-surface/50',
    'primary' => 'border-primary bg-primary text-on-primary/50 dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary/50',
    'secondary' => 'border-secondary bg-secondary text-on-secondary/50 dark:border-secondary-dark dark:bg-secondary-dark dark:text-on-secondary-dark/50',
    'info' => 'border-info bg-info text-on-info/50',
    'success' => 'border-success bg-success text-on-success/50',
    'warning' => 'border-warning bg-warning text-on-warning/50',
    'danger' => 'border-danger bg-danger text-on-danger/50',
    default => 'border-outline bg-surface-alt text-on-surface/50 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark/50',
};

$statusColorClass = match ($status) {
    'info' => 'border-surface dark:border-surface-dark bg-info',
    'success' => 'border-surface dark:border-surface-dark bg-success',
    'warning' => 'border-surface dark:border-surface-dark bg-warning',
    'danger' => 'border-surface dark:border-surface-dark bg-danger',
    default => 'border-surface dark:border-surface-dark bg-outline dark:bg-outline-dark',
};

$sizeClass = match ($size) {
    'xs' => 'size-8',
    'sm' => 'size-10',
    'lg' => 'size-14',
    default => 'size-12',
};

$indicatorSize = match ($size) {
    'xs' => 'size-2',
    'sm' => 'size-3',
    'lg' => 'size-5',
    default => 'size-4',
};
?>

@if($placeholderIcon)
    <div
        {{ $attributes->twMerge('relative flex items-center justify-center rounded-full border ' . $placeholderColorClass . ' ' . $sizeClass) }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif>
        <i class="{{ $placeholderIcon }}"></i>
        @if($status)
            <span
                class="absolute bottom-0.5 end-0 rounded-full border-2 {{ $indicatorSize }} {{ $statusColorClass }}"></span>
        @endif
    </div>
@elseif($placeholderInitials)
    <div
        {{ $attributes->twMerge('relative flex items-center justify-center rounded-full border ' . $placeholderColorClass . ' ' . $sizeClass) }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif>
        {{ $placeholderInitials }}
        @if($status)
            <span
                class="absolute bottom-0.5 end-0 rounded-full border-2 {{ $indicatorSize }} {{ $statusColorClass }}"></span>
        @endif
    </div>
@else
    @if($status)
        <div class="relative w-fit" @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
            <img {{ $attributes->twMerge('rounded-full object-cover object-center ' . $sizeClass) }}>
            <span
                class="absolute bottom-0.5 end-0 rounded-full border-2 {{ $indicatorSize }} {{ $statusColorClass }}"></span>
        </div>
    @else
        <img {{ $attributes->twMerge('rounded-full object-cover object-center ' . $sizeClass) }} @if($tooltip) x-data
             x-tooltip.raw="{{ $tooltip }}" @endif>
    @endif
@endif
