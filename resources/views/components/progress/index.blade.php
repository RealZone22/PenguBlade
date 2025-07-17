@props([
    'min' => 0,
    'max' => 100,
    'label' => null,
    'hint' => null,
    'tooltip' => null,
])

<div>
    <div
        x-data="{ minVal: {{ $min }}, maxVal: {{ $max }}, calcPercentage(min, max, val){return (((val-min)/(max-min))*100).toFixed(0)} }"
        class="w-full">
        @if($label)
            <div class="mb-1 gap-2 text-on-surface dark:text-on-surface-dark">
                <span>{{ $label }}</span>
            </div>
        @endif

            <div @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            {{ $attributes->twMerge('flex h-2.5 w-full overflow-hidden rounded-radius bg-surface-alt dark:bg-surface-dark-alt') }}
            role="progressbar" x-bind:aria-valuemin="minVal" x-bind:aria-valuemax="maxVal">
            {{ $slot }}
        </div>
    </div>


    @if($hint)
        <p class="mt-1 text-sm text-on-surface dark:text-on-surface-dark">{{ $hint }}</p>
    @endif
</div>
