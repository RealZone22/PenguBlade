@props([
    'striped' => true,
])

<tr {{ $attributes->twMerge($striped ? 'even:bg-on-surface/5 dark:even:bg-on-surface-dark/5' : '') }}>
    {{ $slot }}
</tr>
