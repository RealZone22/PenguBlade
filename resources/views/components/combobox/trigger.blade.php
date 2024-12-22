<button type="button" role="combobox"
        {{ $attributes->twMerge('inline-flex w-full items-center justify-between gap-2 whitespace-nowrap bg-neutral-50 px-4 py-2 text-sm font-medium capitalize tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:bg-neutral-900/50 dark:text-neutral-300 dark:focus-visible:outline-white rounded-md') }}
        aria-haspopup="listbox" x-bind:aria-controls="`${uuid}List`" x-on:click="isOpen = ! isOpen"
        x-on:keydown.down.prevent="openedWithKeyboard = true"
        x-on:keydown.enter.prevent="openedWithKeyboard = true"
        x-on:keydown.space.prevent="openedWithKeyboard = true" x-bind:aria-label="setLabelText()"
        x-bind:aria-expanded="isOpen || openedWithKeyboard">
            <span class="text-sm w-full font-normal text-start overflow-hidden text-ellipsis  whitespace-nowrap"
                  x-text="setLabelText()">
                {{ $slot }}
            </span>
</button>
