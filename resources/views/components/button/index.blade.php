@props([
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'link' => null,
    'loading' => null,
    'tooltip' => null,
    'hideTextWhileLoading' => false,
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

    $baseClass = 'inline-flex items-center justify-center whitespace-nowrap mb-0 cursor-pointer border rounded-radius text-sm font-medium tracking-wide transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed box-border leading-none m-0 p-0';

    $sizeClass = match($size) {
        'sm' => 'px-2 py-1 text-xs',
        'lg' => 'px-6 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };

    $loadingSize = match($size) {
        'sm' => 'size-4',
        'lg' => 'size-6',
        default => 'size-5',
    };

    $solidColorClass = match($color) {
        'secondary' => 'bg-secondary border-secondary text-on-secondary focus-visible:outline-secondary dark:bg-secondary-dark dark:border-secondary-dark dark:text-on-secondary-dark dark:focus-visible:outline-secondary-dark',
        'alternate' => 'bg-surface-alt border-surface-alt text-on-surface-strong focus-visible:outline-surface-alt dark:bg-surface-dark-alt dark:border-surface-dark-alt dark:text-on-surface-dark-strong dark:focus-visible:outline-surface-dark-alt',
        'inverse' => 'bg-surface-dark border-surface-dark text-on-surface-dark focus-visible:outline-surface-dark dark:bg-surface dark:border-surface dark:text-on-surface dark:focus-visible:outline-surface',
        'info' => 'bg-info border-info text-on-info focus-visible:outline-info dark:bg-info dark:border-info dark:text-on-info dark:focus-visible:outline-info',
        'danger' => 'bg-danger border-danger text-on-danger focus-visible:outline-danger dark:bg-danger dark:border-danger dark:text-on-danger dark:focus-visible:outline-danger',
        'warning' => 'bg-warning border-warning text-on-warning focus-visible:outline-warning dark:bg-warning dark:border-warning dark:text-on-warning dark:focus-visible:outline-warning',
        'success' => 'bg-success border-success text-on-success focus-visible:outline-success dark:bg-success dark:border-success dark:text-on-success dark:focus-visible:outline-success',
        default => 'bg-primary border-primary text-on-primary dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark',
    };

    $outlineColorClass = match($color) {
        'secondary' => 'bg-transparent border-secondary text-secondary dark:border-secondary-dark dark:text-secondary-dark dark:focus-visible:outline-secondary-dark',
        'alternate' => 'bg-transparent border-outline text-outline dark:border-outline-dark dark:text-outline-dark dark:focus-visible:outline-outline-dark',
        'inverse' => 'bg-transparent border-surface-dark text-surface-dark dark:border-surface dark:text-surface dark:focus-visible:outline-surface',
        'info' => 'bg-transparent border-info text-info dark:border-info dark:text-info dark:focus-visible:outline-info',
        'danger' => 'bg-transparent border-danger text-danger dark:border-danger dark:text-danger dark:focus-visible:outline-danger',
        'warning' => 'bg-transparent border-warning text-warning dark:border-warning dark:text-warning dark:focus-visible:outline-warning',
        'success' => 'bg-transparent border-success text-success dark:border-success dark:text-success dark:focus-visible:outline-success',
        default => 'bg-transparent border-primary text-primary dark:border-primary-dark dark:text-primary-dark dark:focus-visible:outline-primary-dark',
    };

    $variantClass = match($variant) {
        'outline' => $outlineColorClass,
        default => $solidColorClass,
    };

    $spinnerClass = match($variant) {
        'solid' => match($color) {
            'secondary' => 'fill-on-secondary dark:fill-on-secondary-dark',
            'alternate' => 'fill-on-surface-strong dark:fill-on-surface-dark-strong',
            'inverse' => 'fill-on-surface-dark dark:fill-on-surface',
            'info' => 'fill-on-info dark:fill-on-info',
            'danger' => 'fill-on-danger dark:fill-on-danger',
            'warning' => 'fill-on-warning dark:fill-on-warning',
            'success' => 'fill-on-success dark:fill-on-success',
            default => 'fill-on-primary dark:fill-on-primary-dark',
        },
        'outline' => match($color) {
            'secondary' => 'dark:fill-on-secondary fill-on-secondary-dark',
            'alternate' => 'dark:fill-on-surface-strong fill-on-surface-dark-strong',
            'inverse' => 'dark:fill-on-surface-dark fill-on-surface',
            'info' => 'dark:fill-on-info fill-on-info',
            'danger' => 'dark:fill-on-danger fill-on-danger',
            'warning' => 'dark:fill-on-warning fill-on-warning',
            'success' => 'dark:fill-on-success fill-on-success',
            default => 'dark:fill-on-primary fill-on-primary-dark',
        },
        default => '',
    };
@endphp

@if($link)
    <a {{ $attributes->twMerge($baseClass . ' ' . $variantClass . ' ' . $sizeClass) }} href="{{ $link }}"
       @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
        {{ $slot }}
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
        @if($loading)
            <svg wire:loading wire:target="{{ loadingTarget($attributes, $loading) }}"
                 aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 class="{{ $spinnerClass }} {{ $loadingSize }} animate-spin motion-reduce:animate-none @if(!$hideTextWhileLoading) mr-1 @endif">
                <path opacity="0.25"
                      d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"/>
                <path
                    d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z"/>
            </svg>
        @endif

        @if($hideTextWhileLoading)
            <span wire:loading.remove wire:target="{{ loadingTarget($attributes, $loading) }}">
                {{ $slot }}
            </span>
        @else
            {{ $slot }}
        @endif
    </button>
@endif

@if($hint)
    <div class="text-gray-400 dark:text-gray-500 text-sm">{{ $hint }}</div>
@endif
