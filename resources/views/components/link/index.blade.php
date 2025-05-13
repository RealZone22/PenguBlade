@props([
    'tooltip' => null,
])

<a {{ $attributes->twMerge('font-medium text-primary underline-offset-2 hover:underline focus:underline focus:outline-hidden dark:text-primary-dark') }} @if($tooltip) x-data
   x-tooltip.raw="{{ $tooltip }}" @endif>
    {{ $slot }}
</a>
