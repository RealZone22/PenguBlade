@props([
    'current' => 20,
    'min' => 0,
    'max' => 100,
    'showText' => false,
    'color' => 'primary',
])


@inject('progressService', 'RealZone22\PenguBlade\Services\PenguBlade\ProgressCvaService')

<div
    x-data="{ currentVal: {{ $current }}, minVal: {{ $min }}, maxVal: {{ $max }}, calcPercentage(min, max, val){return (((val-min)/(max-min))*100).toFixed(0)} }"
    class="flex h-4 w-full overflow-hidden rounded-md bg-neutral-50 dark:bg-neutral-900" role="progressbar"
    aria-label="default progress bar" :aria-valuenow="currentVal" :aria-valuemin="minVal" :aria-valuemax="maxVal">

    @if($showText)
        <div
            {{ $attributes->twMerge('h-full rounded-md bg-black p-0.5 text-center text-xs font-semibold leading-none ' . $progressService::new()(['color' => $color])) }}
            :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%`">
            <span x-text="`${calcPercentage(minVal, maxVal, currentVal)}%`"></span>
        </div>
    @else
        <div
            {{ $attributes->twMerge('flex h-2.5 w-full overflow-hidden rounded-md ' . $progressService::new()(['color' => $color])) }}
            :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%`">
        </div>
    @endif
</div>
