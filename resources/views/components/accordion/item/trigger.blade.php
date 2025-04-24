<button :id="uuid" type="button"
        {{ $attributes->twMerge('flex w-full items-center justify-between gap-4 bg-surface-alt p-4 text-left underline-offset-2 hover:bg-surface-alt/75 focus-visible:bg-surface-alt/75 focus-visible:underline focus-visible:outline-hidden dark:bg-surface-dark-alt dark:hover:bg-surface-dark-alt/75 dark:focus-visible:bg-surface-dark-alt/75') }}
        :aria-controls="uuid" @click="selectedAccordionItem = uuid"
        :class="selectedAccordionItem === uuid ? 'text-on-surface-strong dark:text-on-surface-dark-strong font-bold'  : 'text-on-surface dark:text-on-surface-dark font-medium'"
        :aria-expanded="selectedAccordionItem === uuid ? 'true' : 'false'">
    {{ $slot }}
</button>
