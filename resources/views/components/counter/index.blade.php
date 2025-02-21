@props([
    'hint' => null,
    'min' => 0,
    'max' => 99999,
    'increment' => 1,
    'decimalPoints' => 0,
    'current' => 0,
    'minusIcon' => 'icon-minus',
    'plusIcon' => 'icon-plus',
    'showRequired' => true,
    'showValidation' => true,
])

<div>
    <div
        x-data="{
            minVal: {{ $min }},
            maxVal: {{ $max }},
            incrementAmount: {{ $increment }},
            decimalPoints: {{ $decimalPoints }},
            uuid: Math.random().toString(20).substring(2, 20),
            updateLivewire(value) {
                $wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', value);
            }
        }"
        class="flex flex-col gap-1">

        <label x-bind:for="uuid" class="pl-1 text-sm text-neutral-600 dark:text-neutral-300">
            {{ $slot }}
            @if($attributes->get('required') && $showRequired)
                <span class="text-red-600">*</span>
            @endif
        </label>

        <div @dblclick.prevent class="flex items-center">
            <button
                type="button"
                @click="$wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', Math.max(minVal, $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} - incrementAmount))"
                class="flex cursor-pointer h-10 items-center justify-center rounded-l-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 dark:focus-visible:outline-white"
                aria-label="subtract">
                <i class="{{ $minusIcon }}"></i>
            </button>

            <input
                wire:model.live="{{ $attributes->whereStartsWith('wire:model')->first() }}"
                x-bind:id="uuid"
                type="text"
                wire:ignore.self
                {{ $attributes->twMerge('border-x-none h-10 w-20 rounded-none border-y border-neutral-300 bg-neutral-50/50 text-center text-neutral-900 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-black dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-white dark:focus-visible:outline-white') }}/>

            <button
                type="button"
                @click="$wire.$set('{{ $attributes->whereStartsWith('wire:model')->first() }}', Math.min(maxVal, $wire.{{ $attributes->whereStartsWith('wire:model')->first() }} + incrementAmount))"
                class="flex cursor-pointer h-10 items-center justify-center rounded-r-md border border-neutral-300 bg-neutral-50 px-4 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 dark:focus-visible:outline-white"
                aria-label="add">
                <i class="{{ $plusIcon }}"></i>
            </button>
        </div>
    </div>

    @if($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-red-600 text-sm">
            {{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}
        </div>
    @endif
</div>
