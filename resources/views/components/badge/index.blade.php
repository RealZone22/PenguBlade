@props([
    'color' => 'default',
    'type' => 'solid',
    'size' => 'sm',
    'tooltip' => null,
])

<?php
$sizeClass = match ($size) {
    'xs' => 'text-xs font-medium px-1 py-0.5',
    'sm' => 'text-xs font-medium px-2 py-0.5',
    'md' => 'text-sm font-medium px-2 py-0.5',
    'lg' => 'text-sm font-medium px-3 py-1',
    default => '',
};
?>


@if($type == 'solid')
        <?php
        $colorClass = match ($color) {
            'inverse' => 'border-outline-dark bg-surface-dark-alt text-on-surface-dark dark:border-outline dark:bg-surface-alt dark:text-on-surface',
            'primary' => 'border-primary bg-primary text-on-primary dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary',
            'secondary' => 'border-secondary bg-secondary text-on-secondary dark:border-secondary-dark dark:bg-secondary-dark dark:text-on-secondary-dark',
            'info' => 'border-info bg-info text-on-info dark:border-info dark:bg-info dark:text-on-info',
            'success' => 'border-success bg-success text-on-success dark:border-success dark:bg-success dark:text-on-success',
            'warning' => 'border-warning bg-warning text-on-warning dark:border-warning dark:bg-warning dark:text-on-warning',
            'danger' => 'border-danger bg-danger text-on-danger dark:border-danger dark:bg-danger dark:text-on-danger',
            default => 'border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark',
        };
        ?>
    <span
        {{ $attributes->twMerge('rounded-radius w-fit border ' . $colorClass . ' ' . $sizeClass) }}>
        {{ $slot }}
    </span>
@endif

@if($type == 'soft')
        <?php
        $colorClass = match ($color) {
            'inverse' => 'border-outline-dark bg-surface text-on-surface dark:border-outline dark:bg-surface-dark dark:text-on-surface-dark',
            'primary' => 'border-primary bg-surface text-primary dark:border-primary-dark dark:bg-surface-dark dark:text-primary-dark',
            'secondary' => 'border-secondary bg-surface text-secondary dark:border-secondary-dark dark:bg-surface-dark dark:text-secondary-dark',
            'info' => 'border-info bg-surface text-info dark:border-info dark:bg-surface-dark dark:text-info',
            'success' => 'border-success bg-surface text-success dark:border-success dark:bg-surface-dark dark:text-success',
            'warning' => 'border-warning bg-surface text-warning dark:border-warning dark:bg-surface-dark dark:text-warning',
            'danger' => 'border-danger bg-surface text-danger dark:border-danger dark:bg-surface-dark dark:text-danger',
            default => 'border-outline bg-surface text-on-surface dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark',
        };

        $colorClassText = match ($color) {
            'inverse' => 'bg-surface-dark-alt/10 dark:bg-surface-alt/10',
            'primary' => 'bg-primary/10 dark:bg-primary-dark/10',
            'secondary' => 'bg-secondary/10 dark:bg-secondary-dark/10',
            'info' => 'bg-info/10 dark:bg-info/10',
            'success' => 'bg-success/10 dark:bg-success/10',
            'warning' => 'bg-warning/10 dark:bg-warning/10',
            'danger' => 'bg-danger/10 dark:bg-danger/10',
            default => 'bg-surface-alt/10 dark:bg-surface-dark-alt/10',
        };
        ?>
    <span
        {{ $attributes->twMerge('w-fit inline-flex overflow-hidden rounded-radius border ' . $colorClass) }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif>
        <span class="{{ $sizeClass }} {{ $colorClassText }}">
            {{ $slot }}
        </span>
    </span>
@endif

