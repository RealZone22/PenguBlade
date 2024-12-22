@props([
    'dividerIcon' => 'icon-chevron-right',
    'isLast' => false,
])

<li class="flex items-center gap-1">
    <a {{ $attributes->twMerge('hover:text-neutral-900 dark:hover:text-white') }}>
        {{ $slot }}
    </a>
    @if(!$isLast)
        <i class="{{ $dividerIcon }}"></i>
    @endif
</li>
