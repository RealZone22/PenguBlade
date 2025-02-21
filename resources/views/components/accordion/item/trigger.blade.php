<button :id="uuid" type="button"
        {{ $attributes->twMerge('flex w-full items-center justify-between gap-4 bg-neutral-50 p-4 text-left underline-offset-2 hover:bg-neutral-50/75 focus-visible:bg-neutral-50/75 focus-visible:underline focus-visible:outline-hidden dark:bg-neutral-900 dark:hover:bg-neutral-900/75 dark:focus-visible:bg-neutral-900/75') }}
        :aria-controls="uuid" @click="selectedAccordionItem = uuid"
        :class="selectedAccordionItem === uuid ? 'text-onSurfaceStrong dark:text-onSurfaceDarkStrong font-bold'  : 'text-onSurface dark:text-onSurfaceDark font-medium'"
        :aria-expanded="selectedAccordionItem === uuid ? 'true' : 'false'">
    {{ $slot }}
</button>
