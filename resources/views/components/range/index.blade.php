@props([
    'current' => 0,
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'label' => null,
    'hint' => null,
    'uuid' => null,
    'tooltip' => null,
    'showValue' => false,
    'showRequired' => false,
    'showValidation' => false,
])

<div
    x-data="{ currentVal: {{ $current }}, uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20) }">
    <div class="flex w-full flex-col gap-4 text-on-surface dark:text-on-surface-dark">
        @if($label)
            <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif
        <div class="flex items-center space-x-4">
            <input x-bind:id="uuid" type="range" x-model="currentVal" @if($tooltip) x-tooltip.raw="{{ $tooltip }}"
                   @endif
                   {{ $attributes->twMerge('h-2 cursor-pointer w-full appearance-none bg-on-surface/15 focus:outline-primary dark:bg-on-surface-dark/15 dark:focus:outline-primary-dark [&::-moz-range-thumb]:size-4 [&::-moz-range-thumb]:appearance-none [&::-moz-range-thumb]:border-none [&::-moz-range-thumb]:bg-primary dark:[&::-moz-range-thumb]:bg-primary-dark active:[&::-moz-range-thumb]:scale-110 [&::-webkit-slider-thumb]:size-4 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:border-none [&::-webkit-slider-thumb]:bg-primary active:[&::-webkit-slider-thumb]:scale-110 dark:[&::-webkit-slider-thumb]:bg-primary-dark [&::-moz-range-thumb]:rounded-full [&::-webkit-slider-thumb]:rounded-full rounded-full') }}
                   value="{{ $current }}" min="{{ $min }}" max="{{ $max }}" step="{{ $step }}"/>

            @if($showValue)
                <span class="w-10 text-lg font-bold text-on-surface-strong dark:text-on-surface-dark-strong"
                      x-text="currentVal"></span>
            @endif
        </div>
    </div>

    @if($hint)
        <p class="mt-1 text-sm text-on-surface dark:text-on-surface-dark">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
