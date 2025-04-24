@props([
    'sticky' => false,
    'dismissible' => false,
    'dismissIcon' => 'icon-x',
    'color' => 'default',
])

<?php
$colorClass = match ($color) {
    'inverse' => 'bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark',
    'primary' => 'bg-primary border-primary text-on-primary dark:bg-primary-dark dark:text-on-primary-dark',
    'secondary' => 'bg-secondary border-secondary text-on-secondary dark:bg-secondary-dark dark:text-on-secondary-dark',
    'info' => 'bg-info border-info text-on-info dark:bg-info-dark dark:text-on-info-dark',
    'success' => 'bg-success border-success text-on-success dark:bg-success-dark dark:text-on-success-dark',
    'warning' => 'bg-warning border-warning text-on-warning dark:bg-warning-dark dark:text-on-warning-dark',
    'danger' => 'bg-danger border-danger text-on-danger dark:bg-danger-dark dark:text-on-danger-dark',
    default => 'bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark',
};
?>


<div
    {{ $attributes->twMerge('flex border-outline p-4 border-b ' . $colorClass . ' ' . ($sticky ? 'fixed inset-x-0 top-0 z-10' : 'relative')) }}
    x-data="{ bannerIsVisible: true }" x-show="bannerIsVisible"
    role="alert" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    {{ $slot }}

    @if($dismissible)
        <button type="button" @click="bannerIsVisible = false"
                class="absolute top-1/2 -translate-y-1/2 right-4 cursor-pointer"
                aria-label="dismiss banner">
            <i class="{{ $dismissIcon }}"></i>
        </button>
    @endif
</div>
