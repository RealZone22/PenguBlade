@props([
    'uuid' => 'pengublade-counter-' . str()->uuid(),
    'hint' => null,
    'min' => 0,
    'max' => 99999,
    'increment' => 1,
    'decimalPoints' => 0,
    'current' => 0,
    'minusIcon' => 'icon-minus',
    'plusIcon' => 'icon-plus',
])

<div
    x-data="{ currentVal: {{ $current }}, minVal: {{ $min }}, maxVal: {{ $max }}, decimalPoints: {{ $decimalPoints }}, incrementAmount: {{ $increment }} }"
    class="flex flex-col gap-1">
    <label for="{{ $uuid }}" class="pl-1 text-sm text-neutral-600 dark:text-neutral-300">{{ $slot }}</label>
    <div @dblclick.prevent class="flex items-center">
        <button @click="currentVal = Math.max(minVal, currentVal - incrementAmount)"
                class="flex h-10 items-center justify-center rounded-l-md bg-neutral-50 px-4 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-neutral-900 dark:text-neutral-300 dark:focus-visible:outline-white"
                aria-label="subtract">
            <i class="{{ $minusIcon }}"></i>
        </button>
        <input x-model="currentVal.toFixed(decimalPoints)" id="{{ $uuid }}" type="text"
            {{ $attributes->twMerge('border-x-none h-10 w-20 rounded-none bg-neutral-50/50 text-center text-neutral-900 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-black dark:bg-neutral-900/50 dark:text-white dark:focus-visible:outline-white') }}/>
        <button @click="currentVal = Math.min(maxVal, currentVal + incrementAmount)"
                class="flex h-10 items-center justify-center rounded-r-md bg-neutral-50 px-4 py-2 text-neutral-600 hover:opacity-75 focus-visible:z-10 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-neutral-900 dark:text-neutral-300 dark:focus-visible:outline-white"
                aria-label="add">
            <i class="{{ $plusIcon }}"></i>
        </button>
    </div>
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
