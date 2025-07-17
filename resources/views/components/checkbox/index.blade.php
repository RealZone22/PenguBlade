@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'description' => null,
    'uuid' => null,
    'size' => 'md',
    'color' => 'primary',
    'tooltip' => null,
])

<?php
$colorClass = match ($color) {
    'secondary' => 'checked:border-secondary checked:before:bg-secondary checked:focus:outline-secondary active:outline-offset-0 dark:checked:border-secondary-dark dark:checked:before:bg-secondary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-secondary-dark',
    'info' => 'checked:border-info checked:before:bg-info checked:focus:outline-info active:outline-offset-0 dark:checked:border-info dark:checked:before:bg-info dark:focus:outline-outline-dark-strong dark:checked:focus:outline-info',
    'success' => 'checked:border-success checked:before:bg-success checked:focus:outline-success active:outline-offset-0 dark:checked:border-success dark:checked:before:bg-success dark:focus:outline-outline-dark-strong dark:checked:focus:outline-success',
    'warning' => 'checked:border-warning checked:before:bg-warning checked:focus:outline-warning active:outline-offset-0 dark:checked:border-warning dark:checked:before:bg-warning dark:focus:outline-outline-dark-strong dark:checked:focus:outline-warning',
    'danger' => 'checked:border-danger checked:before:bg-danger checked:focus:outline-danger active:outline-offset-0 dark:checked:border-danger dark:checked:before:bg-danger dark:focus:outline-outline-dark-strong dark:checked:focus:outline-danger',
    default => 'checked:border-primary checked:before:bg-primary checked:focus:outline-primary active:outline-offset-0 dark:checked:border-primary-dark dark:checked:before:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark'
};

$textSizeClass = match ($size) {
    'sm' => 'text-xs',
    'lg' => 'text-base',
    'xl' => 'text-lg',
    default => 'text-sm'
};

$sizeClass = match ($size) {
    'sm' => 'size-3',
    'lg' => 'size-5',
    'xl' => 'size-6',
    default => 'size-4'
};
?>

<div x-data="{ uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20) }">
    <label x-bind:for="uuid"
           class="flex cursor-pointer items-center gap-2 text-sm font-medium text-neutral-600 dark:text-neutral-300 [&:has(input:checked)]:text-neutral-900 dark:[&:has(input:checked)]:text-white [&:has(input:disabled)]:opacity-75 [&:has(input:disabled)]:cursor-not-allowed">
        <div class="relative flex items-center">
            <input x-bind:id="uuid" type="checkbox"
                {{ $attributes->twMerge("before:content[''] peer relative appearance-none overflow-hidden rounded-sm border border-outline bg-surface-alt before:absolute before:inset-0 focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt " . $colorClass . " " . $sizeClass) }}/>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                 fill="none"
                 stroke-width="4"
                 class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-neutral-100 peer-checked:visible dark:text-black">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
        </div>
        @if($label)
            <span class="{{ $textSizeClass }}" @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif>
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </span>
        @endif
    </label>

    @if($description)
        <span class="ml-6 text-sm text-on-surface dark:text-on-surface-dark">{{ $description }}</span>
    @endif

    @if($hint)
        <p class="text-on-surface dark:text-on-surface-dark dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
