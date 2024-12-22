@props([
    'variant' => null,
    'color' => 'primary',
    'link' => null,
    'loading' => null,
    'hint' => null,
])

@php
    if (!function_exists('loadingTarget')) {
        function loadingTarget($attributes, $loading): ?string
        {
            if ($loading == 1) {
                return $attributes->whereStartsWith('wire:click')->first();
            }

            return $loading;
        }
    }
@endphp

@inject('buttonService', 'RealZone22\PenguBlade\Services\PenguBlade\ButtonCvaService')
@inject('spinnerService', 'RealZone22\PenguBlade\Services\PenguBlade\SpinnerCvaService')

@if($link)
    <a {{ $attributes->twMerge($buttonService::new()([$variant => $color])) }} href="{{ $link }}"
       @if($loading)
           wire:target="{{ loadingTarget($attributes, $loading) }}"
       wire:loading.attr="disabled"
        @endif
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->twMerge($buttonService::new()([$variant => $color])) }}
            @if($loading)
                wire:target="{{ loadingTarget($attributes, $loading) }}"
            wire:loading.attr="disabled"
        @endif
    >
        @if($loading)
            <svg wire:loading wire:target="{{ loadingTarget($attributes, $loading) }}"
                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 class="{{ $spinnerService::new()(['color' => $color]) }}">
                <path opacity="0.25"
                      d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"/>
                <path
                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"/>
            </svg>
        @endif

        {{ $slot }}
    </button>
@endif
@if($hint)
    <div class="text-gray-400 dark:text-gray-500 py-1 pb-0 text-sm">{{ $hint }}</div>
@endif
