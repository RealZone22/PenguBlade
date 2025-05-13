@props([
    'last' => false,
    'separator' => '>',
    'tooltip' => null,
])

@if($last)
    <li {{ $attributes->twMerge('flex items-center text-on-surface-strong gap-1 font-bold dark:text-on-surface-dark-strong') }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif
        aria-current="page">
        {{ $slot }}
    </li>
@else
    <li class="flex items-center gap-1" @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
        <a {{ $attributes->twMerge('hover:text-on-surface-strong dark:hover:text-on-surface-dark-strong') }}>{{ $slot }}</a>
        {{ $separator }}
    </li>
@endif
