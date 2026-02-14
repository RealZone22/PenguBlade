@props([
    'label' => null,
    'hint' => null,
    'uuid' => null,
    'icon' => null,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
    'mode' => 'single', // 'single' | 'range'
    'min' => null,
    'max' => null,
    'placeholder' => null,
])

@php
    $uuid = $uuid ?: 'dp-'.bin2hex(random_bytes(6));
    $isRange = $mode === 'range';
    $inputClass = 'w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark'.($icon ? ' pl-10' : '');
@endphp

<div class="flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark">
    @if($label)
        <label for="{{ $uuid }}-date" class="w-fit pl-0.5 text-sm">
            {{ $label }}
            @if($attributes->get('required') && $showRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    @if($icon)
        <div class="relative">
            <i class="{{ $icon }} absolute left-2.5 top-1/2 -translate-y-1/2 z-10 text-gray-500 dark:text-neutral-500 pointer-events-none"></i>
    @endif

    <div class="{{ $isRange ? 'flex flex-wrap items-center gap-2' : '' }} @if($icon) relative @endif">
        @if($isRange)
            @php
                $nameBase = $attributes->get('name');
                $baseAttrs = $attributes->filter(fn ($value, $key) => $key !== 'class' && $key !== 'name' && !str_starts_with((string) $key, 'wire:model'));
            @endphp
            <input
                type="date"
                id="{{ $uuid }}-start"
                aria-label="{{ $label ? $label.' (start)' : 'Start date' }}"
                @if($nameBase) name="{{ $nameBase }}_start" @endif
                @if($min) min="{{ $min }}" @endif
                @if($max) max="{{ $max }}" @endif
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                {{ $baseAttrs->twMerge($inputClass) }}
            />
            <span class="text-on-surface/60 dark:text-on-surface-dark/60 text-sm shrink-0" aria-hidden="true">–</span>
            <input
                type="date"
                id="{{ $uuid }}-end"
                aria-label="{{ $label ? $label.' (end)' : 'End date' }}"
                @if($nameBase) name="{{ $nameBase }}_end" @endif
                @if($min) min="{{ $min }}" @endif
                @if($max) max="{{ $max }}" @endif
                {{ $baseAttrs->twMerge($inputClass) }}
            />
        @else
            <input
                type="date"
                id="{{ $uuid }}-date"
                @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
                @if($min) min="{{ $min }}" @endif
                @if($max) max="{{ $max }}" @endif
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                {{ $attributes->twMerge($inputClass) }}
            />
        @endif
    </div>

    @if($icon)
        </div>
    @endif

    @if($hint)
        <p class="text-on-surface/50 dark:text-on-surface-dark/50 text-xs mt-1">
            {{ $hint }}
        </p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
