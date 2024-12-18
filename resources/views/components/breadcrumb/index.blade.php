<nav {{ $attributes->twMerge('text-sm font-medium text-neutral-600 dark:text-neutral-300') }} aria-label="breadcrumb">
    <ol class="flex flex-wrap items-center gap-1">
        {{ $slot }}
    </ol>
</nav>
