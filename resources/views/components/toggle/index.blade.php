@props([
    'label' => null,
    'color' => 'primary',
    'size' => 'md',
    'placement' => 'right',
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
])

<?php

$colorClass = match ($color) {
    'secondary' => "peer-checked:bg-secondary peer-checked:after:bg-on-secondary peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-secondary peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-secondary-dark dark:peer-checked:after:bg-on-secondary-dark dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-secondary-dark",
    'success' => "peer-checked:bg-success peer-checked:after:bg-on-success peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-success peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-success dark:peer-checked:after:bg-on-success dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-success",
    'warning' => "peer-checked:bg-warning peer-checked:after:bg-on-warning peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-warning peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-warning dark:peer-checked:after:bg-on-warning dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-warning",
    'danger' => "peer-checked:bg-danger peer-checked:after:bg-on-danger peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-danger peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-danger dark:peer-checked:after:bg-on-danger dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-danger",
    'info' => "peer-checked:bg-info peer-checked:after:bg-on-info peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-info peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-info dark:peer-checked:after:bg-on-info dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-info",
    default => "peer-checked:bg-primary peer-checked:after:bg-on-primary peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-outline-strong peer-focus:peer-checked:outline-primary peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-outline-dark dark:bg-surface-dark-alt dark:after:bg-on-surface-dark dark:peer-checked:bg-primary-dark dark:peer-checked:after:bg-on-primary-dark dark:peer-focus:outline-outline-dark-strong dark:peer-focus:peer-checked:outline-primary-dark",
};

$sizeClass = match ($size) {
    'sm' => 'h-5 w-9 after:h-4 after:w-4',
    'lg' => 'h-7 w-12 after:h-6 after:w-6',
    'xl' => 'h-8 w-14 after:h-7 after:w-7',
    default => 'h-6 w-11 after:h-5 after:w-5',
};

$textSizeClass = match ($size) {
    'sm' => 'text-xs',
    'lg' => 'text-base',
    'xl' => 'text-lg',
    default => 'text-sm',
};

?>

<div x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">

    <label x-bind:for="uuid" class="inline-flex items-center gap-3 cursor-pointer"
           @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif>
        <input x-bind:id="uuid" type="checkbox" class="peer sr-only" role="switch" {{ $attributes->except('class') }} />

        @if($label && $placement == 'left')
            <span
                class="{{ $textSizeClass }} trancking-wide font-medium text-on-surface peer-checked:text-on-surface-strong peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-on-surface-dark dark:peer-checked:text-on-surface-dark-strong">{{ $label }}</span>
        @endif

        <div
            {{ $attributes->only('class')->twMerge("relative cursor-pointer peer-checked:after:translate-x-5 rounded-full border border-outline bg-surface-alt after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-on-surface after:transition-all after:content-[''] " . $colorClass . ' ' . $sizeClass) }}
            aria-hidden="true"></div>

        @if($label && $placement == 'right')
            <span
                class="{{ $textSizeClass }} trancking-wide font-medium text-on-surface peer-checked:text-on-surface-strong peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-on-surface-dark dark:peer-checked:text-on-surface-dark-strong">{{ $label }}</span>
        @endif
    </label>

    @if($hint)
        <p class="text-sm text-on-surface dark:text-on-surface-dark">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
