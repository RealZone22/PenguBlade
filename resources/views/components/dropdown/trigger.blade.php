<button type="button" @click="isOpen = ! isOpen"
        {{ $attributes->twMerge('inline-flex cursor-pointer items-center gap-2 whitespace-nowrap rounded-md bg-neutral-50 px-4 py-2 text-sm font-medium tracking-wide transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-neutral-800 dark:bg-neutral-900 dark:focus-visible:outline-neutral-300') }}
        aria-haspopup="true" @keydown.space.prevent="openedWithKeyboard = true"
        @keydown.enter.prevent="openedWithKeyboard = true" @keydown.down.prevent="openedWithKeyboard = true"
        :class="isOpen || openedWithKeyboard ? 'text-neutral-900 dark:text-white' : 'text-neutral-600 dark:text-neutral-300'"
        :aria-expanded="isOpen || openedWithKeyboard">
    {{ $slot }}
</button>
