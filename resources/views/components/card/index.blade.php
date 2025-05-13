@props([
    'loading' => false,
    'tooltip' => null,
])

@if($loading)
    <article
        {{ $attributes->twMerge('flex rounded-radius p-4 flex-col overflow-hidden animate-pulse bg-on-surface/30 dark:bg-on-surface-dark/30') }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif>
    </article>
@else
    <article
        {{ $attributes->twMerge('flex rounded-radius p-4 flex-col overflow-hidden border border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark') }} @if($tooltip) x-data
        x-tooltip.raw="{{ $tooltip }}" @endif>
        {{ $slot }}
    </article>
@endif
