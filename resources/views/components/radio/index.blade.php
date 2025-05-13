@props([
    'label' => null,
    'description' => null,
    'hint' => null,
    'uuid' => null,
    'color' => 'primary',
    'showRequired' => false,
    'showValidation' => false,
    'tooltip' => null,
])

<?php

$colorClass = match ($color) {
    'secondary' => " before:bg-on-secondary checked:border-secondary checked:bg-secondary checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-secondary disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-secondary-dark dark:checked:border-secondary-dark dark:checked:bg-secondary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-secondary-dark",
    'success' => " before:bg-on-success checked:border-success checked:bg-success checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-success disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-success dark:checked:border-success dark:checked:bg-success dark:focus:outline-outline-dark-strong dark:checked:focus:outline-success",
    'info' => " before:bg-on-info checked:border-info checked:bg-info checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-info disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-info dark:checked:border-info dark:checked:bg-info dark:focus:outline-outline-dark-strong dark:checked:focus:outline-info",
    'warning' => " before:bg-on-warning checked:border-warning checked:bg-warning checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-warning disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-warning dark:checked:border-warning dark:checked:bg-warning dark:focus:outline-outline-dark-strong dark:checked:focus:outline-warning",
    'danger' => " before:bg-on-danger checked:border-danger checked:bg-danger checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-danger disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-danger dark:checked:border-danger dark:checked:bg-danger dark:focus:outline-outline-dark-strong dark:checked:focus:outline-danger",
    default => " before:bg-on-primary checked:border-primary checked:bg-primary checked:before:visible focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-primary disabled:cursor-not-allowed dark:border-outline-dark dark:bg-surface-dark-alt dark:before:bg-on-primary-dark dark:checked:border-primary-dark dark:checked:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark"
}

?>

<div x-data="{ uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20) }">
    @if($description)
        <div class="flex flex-col text-on-surface dark:text-on-surface-dark">
            <div
                class="flex items-center justify-start gap-2 font-medium text-on-surface has-disabled:opacity-75 dark:text-on-surface-dark cursor-pointer">
                <input x-bind:id="uuid" type="radio" @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                       {{ $attributes->twMerge("before:content[''] cursor-pointer relative h-4 w-4 appearance-none rounded-full border border-outline bg-surface-alt before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full " . $colorClass) }}
                       value="">

                @if($label)
                    <label x-bind:for="uuid" class="text-sm cursor-pointer"
                           @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif>
                        {{ $label }}

                        @if($attributes->get('required') && $showRequired)
                            <span class="text-danger">*</span>
                        @endif
                    </label>
                @endif
            </div>
            <span class="ml-6 text-sm">{{ $description }}</span>
        </div>
    @else
        <div
            class="flex items-center justify-start gap-2 font-medium text-on-surface has-disabled:opacity-75 dark:text-on-surface-dark cursor-pointer">
            <input x-bind:id="uuid" type="radio" @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                   {{ $attributes->twMerge("before:content[''] cursor-pointer relative h-4 w-4 appearance-none rounded-full border border-outline bg-surface-alt before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full " . $colorClass) }}
                   value="">

            @if($label)
                <label x-bind:for="uuid" class="text-sm cursor-pointer"
                       @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif>
                    {{ $label }}
                </label>
            @endif
        </div>
    @endif

    @if($hint)
        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
