@props([
    'label' => null,
    'hint' => null,
    'min' => 0,
    'max' => 99999999,
    'increment' => 1,
    'decimalPoints' => 0,
    'current' => 0,
    'minusIcon' => 'icon-minus',
    'plusIcon' => 'icon-plus',
    'showRequired' => true,
    'showValidation' => true,
    'uuid' => null,
    'tooltip' => null,
])

<div>
    <div
        x-data="{
            minVal: {{ $min }},
            maxVal: {{ $max }},
            incrementAmount: {{ $increment }},
            decimalPoints: {{ $decimalPoints }},
            uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20),
            updateLivewire(value) {
                $wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', value);
            }
        }"
        class="flex flex-col gap-1">

        @if($label)
            <label x-bind:for="uuid" class="pl-1 text-sm text-on-surface dark:text-on-surface-dark">
                {{ $label }}
                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif

        <div @dblclick.prevent class="flex items-center">
            <button
                type="button"
                @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                @click="$wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', Math.max(minVal, $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} - incrementAmount))"
                class="flex cursor-pointer h-10 items-center justify-center rounded-l-radius border border-outline bg-surface-alt px-4 py-2 text-on-surface hover:opacity-75 focus-visible:z-10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark dark:focus-visible:outline-primary-dark"
                aria-label="subtract">
                <i class="{{ $minusIcon }}"></i>
            </button>

            <input
                wire:model.live="{{ $attributes->whereStartsWith('wire:model')->first() }}"
                x-bind:id="uuid"
                type="text"
                wire:ignore.self
                @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                {{ $attributes->twMerge('border-x-none h-10 w-20 rounded-none border-y border-outline bg-surface-alt/50 text-center text-on-surface-strong focus-visible:z-10 focus-visible:outline-2 focus-visible:outline-primary dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark') }}/>

            <button
                type="button"
                @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                @click="$wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', Math.min(maxVal, $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} + incrementAmount))"
                class="flex cursor-pointer h-10 items-center justify-center rounded-r-radius border border-outline bg-surface-alt px-4 py-2 text-on-surface hover:opacity-75 focus-visible:z-10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark dark:focus-visible:outline-primary-dark"
                aria-label="add">
                <i class="{{ $plusIcon }}"></i>
            </button>
        </div>
    </div>

    @if($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">
            {{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}
        </div>
    @endif
</div>
