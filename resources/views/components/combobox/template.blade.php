<ul x-cloak x-show="isOpen || openedWithKeyboard" x-bind:id="`${uuid}List`"
    class="absolute z-10 left-0 top-11 flex max-h-44 w-full flex-col overflow-hidden overflow-y-auto bg-neutral-50 py-1.5 dark:bg-neutral-900 rounded-md"
    role="listbox" x-on:click.outside="isOpen = false, openedWithKeyboard = false"
    x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()"
    x-transition x-trap="openedWithKeyboard">
    <template x-for="(item, index) in options" x-bind:key="item.value">
        <!-- option  -->
        <li role="option">
            <label
                class="flex cursor-pointer items-center gap-2 px-4 py-3 text-sm font-medium text-neutral-600 hover:bg-neutral-950/5 has-focus:bg-neutral-950/5 dark:text-neutral-300 dark:hover:bg-white/5 dark:has-focus:bg-white/5 [&:has(input:checked)]:text-neutral-900 dark:[&:has(input:checked)]:text-white [&:has(input:disabled)]:cursor-not-allowed [&:has(input:disabled)]:opacity-75"
                x-bind:for="'checkboxOption' + index">
                <div class="relative flex items-center">
                    <input type="checkbox"
                           {{ $attributes->twMerge("combobox-option before:content[''] peer relative size-4 cursor-pointer appearance-none overflow-hidden border border-neutral-300 bg-neutral-50 before:absolute before:inset-0 checked:border-black checked:before:bg-black focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black active:outline-offset-0 disabled:cursor-not-allowed dark:border-neutral-700 rounded-xs dark:bg-neutral-900 dark:checked:border-white dark:checked:before:bg-white dark:focus:outline-neutral-300 dark:checked:focus:outline-white") }}
                           x-on:change="handleOptionToggle($el)"
                           x-on:keydown.enter.prevent="$el.checked = ! $el.checked; handleOptionToggle($el)"
                           x-bind:value="item.value" x-bind:id="'checkboxOption' + index"/>
                    <!-- Checkmark  -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                         fill="none" stroke-width="4"
                         class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-neutral-100 peer-checked:visible dark:text-black"
                         aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
                <span x-text="item.label"></span>
            </label>
        </li>
    </template>
</ul>
