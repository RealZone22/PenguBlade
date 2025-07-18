@props([
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'link' => null,
    'loading' => null,
    'hideTextWhileLoading' => true,
    'hint' => null,
    'icon' => null,
    'tooltip' => null,
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

    $baseClass = 'inline-flex justify-center items-center cursor-pointer mb-0 aspect-square whitespace-nowrap rounded-full border font-medium tracking-wide transition hover:opacity-75 text-center';

    $sizeClass = match($size) {
        'sm' => 'p-2 text-xs',
        'lg' => 'p-6 text-base',
        default => 'p-4 text-sm',
    };

    $loadingSize = match($size) {
        'sm' => 'size-4',
        'lg' => 'size-6',
        default => 'size-5',
    };

    $iconSizeClass = match($size) {
        'sm' => 'size-4',
        'lg' => 'size-6',
        default => 'size-5',
    };

    $solidColorClass = match($color) {
        'secondary' => 'border-secondary bg-secondary text-on-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-secondary-dark dark:bg-secondary-dark dark:text-on-secondary-dark dark:focus-visible:outline-secondary-dark',
        'alternate' => 'border-surface-alt bg-surface-alt text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-alt active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-surface-dark-alt dark:bg-surface-dark-alt dark:text-on-surface-dark-strong dark:focus-visible:outline-surface-dark-alt',
        'inverse' => 'border-surface-dark bg-surface-dark text-on-surface-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-dark active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-surface dark:bg-surface dark:text-on-surface dark:focus-visible:outline-surface',
        'info' => 'border-info bg-info text-on-info  focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-info active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-info dark:bg-info dark:text-on-info dark:focus-visible:outline-info',
        'danger' => 'border-danger bg-danger text-on-danger focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-danger dark:bg-danger dark:text-on-danger dark:focus-visible:outline-danger',
        'warning' => 'border-warning bg-warning text-on-warning focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-warning active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-warning dark:bg-warning dark:text-on-warning dark:focus-visible:outline-warning',
        'success' => 'border-success bg-success text-on-success focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-success dark:bg-success dark:text-on-success dark:focus-visible:outline-success',
        default => 'border-primary bg-primary text-on-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark',
    };

    $outlineColorClass = match($color) {
        'secondary' => 'border-secondary text-secondary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-secondary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-secondary-dark dark:text-secondary-dark dark:focus-visible:outline-secondary-dark',
        'alternate' => 'border-surface-alt text-surface-alt focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-alt active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-surface-dark-alt dark:text-surface-dark-alt dark:focus-visible:outline-surface-dark-alt',
        'inverse' => 'border-surface-dark text-surface-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-dark active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-surface dark:text-surface dark:focus-visible:outline-surface',
        'info' => 'border-info text-info focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-info active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-info dark:text-info dark:focus-visible:outline-info',
        'danger' => 'border-danger text-danger focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-danger active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-danger dark:text-danger dark:focus-visible:outline-danger',
        'warning' => 'border-warning text-warning focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-warning active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-warning dark:text-warning dark:focus-visible:outline-warning',
        'success' => 'border-success text-success focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-success active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-success dark:text-success dark:focus-visible:outline-success',
        default => 'border-primary text-primary focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-primary-dark dark:text-primary-dark dark:focus-visible:outline-primary-dark',
    };

    $variantClass = match($variant) {
        'outline' => $outlineColorClass,
        default => $solidColorClass,
    };

    $textClass = match($variant) {
        'secondary' => 'fill-on-secondary dark:fill-on-secondary-dark',
        'alternate' => 'fill-on-surface-strong dark:fill-on-surface-dark-strong',
        'inverse' => 'fill-on-surface-dark dark:fill-on-surface',
        'info' => 'fill-on-info dark:fill-on-info',
        'danger' => 'fill-on-danger dark:fill-on-danger',
        'warning' => 'fill-on-warning dark:fill-on-warning',
        'success' => 'fill-on-success dark:fill-on-success',
        default => 'fill-on-primary dark:fill-on-primary-dark',
    };
@endphp

@if($link)
    <a {{ $attributes->twMerge($baseClass . ' ' . $variantClass . ' ' . $sizeClass) }} href="{{ $link }}"
       @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
        <span class="block h-full w-full flex items-center justify-center">
            {{ $slot }}
        </span>
    </a>
@else
    <button {{ $attributes->twMerge($baseClass . ' ' . $variantClass . ' ' . $sizeClass) }} @if($tooltip) x-data
            x-tooltip.raw="{{ $tooltip }}" @endif
            @if(!$attributes->whereStartsWith('type')->first())
                type="button"
            @endif
            @if($loading)
                wire:target="{{ loadingTarget($attributes, $loading) }}" wire:loading.attr="disabled"
            @endif
    >
        <span class="block h-full w-full flex items-center justify-center">
            @if($loading)
                <svg wire:loading wire:target="{{ loadingTarget($attributes, $loading) }}"
                     aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     class="{{ $textClass }} {{ $loadingSize }} animate-spin motion-reduce:animate-none @if(!$hideTextWhileLoading) mr-1 @endif">
                    <path opacity="0.25"
                          d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"/>
                    <path
                            d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"/>
                </svg>
            @endif

            @if($hideTextWhileLoading)
                <span wire:loading.remove wire:target="{{ loadingTarget($attributes, $loading) }}"
                      class="inline-flex items-center justify-center">
                    @if($icon)
                        <i class="{{ $icon }} {{ $iconSizeClass }} {{ $textClass }}"></i>
                    @endif
                    {{ $slot }}
                </span>
            @else
                <span class="inline-flex items-center justify-center">
                    @if($icon)
                        <i class="{{ $icon }} {{ $iconSizeClass }} {{ $textClass }}"></i>
                    @endif
                    {{ $slot }}
                </span>
            @endif
        </span>
    </button>
@endif

@if($hint)
    <div class="text-on-surface dark:text-on-surface-dark text-sm">{{ $hint }}</div>
@endif
