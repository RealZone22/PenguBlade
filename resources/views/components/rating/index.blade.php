@props([
    'amount' => 5,
    'current' => 0,
    'uuid' => 'pengublade-rating-' . str()->uuid(),
    'icon' => 'icon-star',
    'hint' => null,
])

<div x-data="{ currentVal: {{ $current }} }" class="flex items-center gap-1">
    @for($i = 1; $i <= $amount; $i++)
        <label
            for="{{ $uuid }}_{{ $i }}" {{ $attributes->twMerge('cursor-pointer transition hover:scale-125 has-[:focus]:scale-125') }}>
            <span class="sr-only">{{ $i }} star</span>
            <input x-model="currentVal" id="{{ $uuid }}_{{ $i }}" type="radio" class="sr-only" name="rating"
                   value="{{ $i }}">
            <i class="{{ $icon }}"
               :class="currentVal >= {{ $i }} ? 'text-amber-500' : 'text-neutral-600 dark:text-neutral-300'"></i>
        </label>
    @endfor
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
