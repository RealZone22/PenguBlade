@props([
    'amount' => 5,
    'current' => 0,
    'icon' => 'icon-star',
    'hint' => null,
    'uuid' => null,
    'tooltip' => null,
    'showRequired' => false,
    'showValidation' => false,
])

<div
    x-data="{ currentVal: {{ $current }}, uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20) }">
    <div class="flex items-center gap-1">
        @for($i = 1; $i <= $amount; $i++)
            <label @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                x-bind:for="uuid + '_' + @{{ $i }}" {{ $attributes->twMerge('transition hover:scale-125 has-focus:scale-125 cursor-pointer') }}>
                <span class="sr-only">{{ $i }} star</span>
                <input x-model="currentVal" x-bind:id="uuid + '_' + @{{ $i }}" type="radio" class="sr-only"
                       name="rating"
                       value="{{ $i }}">
                <i class="{{ $icon }}"
                   :class="currentVal >= {{ $i }} ? 'text-amber-500' : 'text-neutral-600 dark:text-neutral-300'"></i>
            </label>
        @endfor
    </div>


    @if($hint)
        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
