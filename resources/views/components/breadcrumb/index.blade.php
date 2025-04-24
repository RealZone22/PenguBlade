<nav
    {{ $attributes->twMerge('text-sm font-medium text-on-surface dark:text-on-surface-dark') }} aria-label="breadcrumb">
    <ol class="flex flex-wrap items-center gap-1">
        {{ $slot }}
    </ol>
</nav>
