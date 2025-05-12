@props([
    'striped' => true,
])

<tr {{ $attributes->twMerge($striped ? 'even:bg-primary/5 dark:even:bg-primary-dark/10' : '') }}>
    {{ $slot }}
</tr>
