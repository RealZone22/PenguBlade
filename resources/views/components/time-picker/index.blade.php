@props([
    'label' => null,
    'hint' => null,
    'uuid' => null,
    'icon' => null,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
    'seconds' => false,
    'min' => null,
    'max' => null,
    'placeholder' => null,
])

@php
    $uuid = $uuid ?: 'tp-'.bin2hex(random_bytes(6));
    $step = $seconds ? '1' : '60';
    $inputClass = 'w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark'.($icon ? ' pl-10' : '');
@endphp

<div class="flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark">
    @if($label)
        <label for="{{ $uuid }}-time" class="w-fit pl-0.5 text-sm">
            {{ $label }}
            @if($attributes->get('required') && $showRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div class="@if($icon) relative @endif">
        @if($icon)
            <i class="{{ $icon }} absolute left-2.5 top-1/2 -translate-y-1/2 z-10 text-gray-500 dark:text-neutral-500 pointer-events-none"></i>
        @endif
        <input
        type="time"
        id="{{ $uuid }}-time"
        step="{{ $step }}"
        @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
        @if($min) min="{{ $min }}" @endif
        @if($max) max="{{ $max }}" @endif
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        {{ $attributes->twMerge($inputClass) }}
    />
    </div>

    @if($hint)
        <p class="text-on-surface/50 dark:text-on-surface-dark/50 text-xs mt-1">
            {{ $hint }}
        </p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
