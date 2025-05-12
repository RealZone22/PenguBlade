@props([
    'loading' => false,
])

@if($loading)
    <article {{ $attributes->twMerge('flex rounded-radius p-4 flex-col overflow-hidden animate-pulse bg-on-surface/30 dark:bg-on-surface-dark/30') }}>
    </article>
@else
    <article {{ $attributes->twMerge('flex rounded-radius p-4 flex-col overflow-hidden border border-outline bg-surface-alt text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark') }}>
        {{ $slot }}
    </article>
@endif
