@props([
    'options' => [],
    'label' => null,
    'placeholder' => null,
    'uuid' => null,
    'hint' => null,
    'chevronIcon' => 'icon-chevron-down',
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'selectedOptions' => []
])

<div x-data="{
        uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20),
        options: {{ json_encode($options) }},
        isOpen: false,
        openedWithKeyboard: false,
        selectedOptions: {{ json_encode($selectedOptions) }},
        setLabelText() {
            const count = this.selectedOptions.length;

            if (count === 0) return '{{ $placeholder }}';

            return this.selectedOptions.join(', ');
        },
        highlightFirstMatchingOption(pressedKey) {
            if (pressedKey === 'Enter') return;

            const option = this.options.find((item) =>
                item.label.toLowerCase().startsWith(pressedKey.toLowerCase()),
            );
            if (option) {
                const index = this.options.indexOf(option);
                const allOptions = document.querySelectorAll('.combobox-option');
                if (allOptions[index]) {
                    allOptions[index].focus();
                }
            }
        },
        handleOptionToggle(option) {
            if (option.checked) {
                this.selectedOptions.push(option.value);
            } else {
                this.selectedOptions = this.selectedOptions.filter(
                    (opt) => opt !== option.value,
                );
            }
            this.$refs.hiddenTextField.value = this.selectedOptions;
            @if($attributes->wire('model')->value())
                @this.set('{{ $attributes->wire('model')->value() }}', this.selectedOptions);
            @endif
        },
    }"
     {{ $attributes->only('class')->twMerge('w-full flex flex-col') }}
     x-on:keydown="highlightFirstMatchingOption($event.key)"
     x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false"
>
    @if($label)
        <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm text-on-surface dark:text-on-surface-dark">
            {{ $label }}
            @if($attributes->get('required') && $showRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div class="relative">
        <!-- trigger button  -->
        <button
            @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            type="button"
            role="combobox"
            class="inline-flex w-full cursor-pointer items-center justify-between gap-2 whitespace-nowrap border-outline bg-surface-alt px-4 py-2 text-sm font-medium capitalize tracking-wide text-on-surface transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:focus-visible:outline-primary-dark border rounded-radius disabled:opacity-75 disabled:cursor-not-allowed"
            aria-haspopup="listbox"
            x-bind:aria-controls="uuid + 'List'"
            x-on:click="isOpen = !isOpen"
            x-on:keydown.down.prevent="openedWithKeyboard = true"
            x-on:keydown.enter.prevent="openedWithKeyboard = true"
            x-on:keydown.space.prevent="openedWithKeyboard = true"
            x-bind:aria-label="setLabelText()"
            x-bind:aria-expanded="isOpen || openedWithKeyboard"
            {{ $attributes->only('disabled') }}
        >
            <span class="text-sm w-full font-normal text-start overflow-hidden text-ellipsis whitespace-nowrap"
                  x-text="setLabelText()"></span>
            <i class="{{ $chevronIcon }} size-5"></i>
        </button>

        <input
            x-bind:id="uuid"
            x-bind:name="uuid"
            type="text"
            x-ref="hiddenTextField"
            hidden
            {{ $attributes->whereStartsWith('wire:model') }}
        />

        <ul
            x-cloak
            x-show="isOpen || openedWithKeyboard"
            x-bind:id="uuid + 'List'"
            class="absolute z-10 left-0 top-11 flex max-h-44 w-full flex-col overflow-hidden overflow-y-auto border-outline bg-surface-alt py-1.5 dark:border-outline-dark dark:bg-surface-dark-alt border rounded-radius"
            role="listbox"
            x-on:click.outside="isOpen = false, openedWithKeyboard = false"
            x-on:keydown.down.prevent="$focus.wrap().next()"
            x-on:keydown.up.prevent="$focus.wrap().previous()"
            x-transition
            x-trap="openedWithKeyboard"
        >
            <template x-for="(item, index) in options" x-bind:key="item.value">
                <!-- option  -->
                <li role="option">
                    <label
                        class="flex items-center cursor-pointer gap-2 px-4 py-3 text-sm font-medium text-on-surface hover:bg-surface-dark/5 has-focus:bg-surface-dark/5 dark:text-on-surface-dark dark:hover:bg-surface/5 dark:has-focus:bg-surface/5 has-checked:text-on-surface-strong dark:has-checked:text-on-surface-dark-strong has-disabled:cursor-not-allowed has-disabled:opacity-75"
                        x-bind:for="uuid + 'Option' + index">
                        <div class="relative flex items-center">
                            <input
                                type="checkbox"
                                class="combobox-option before:content[''] peer relative size-4 appearance-none overflow-hidden border border-outline bg-surface-alt before:absolute before:inset-0 checked:border-primary checked:before:bg-primary focus:outline-2 focus:outline-offset-2 focus:outline-outline-strong checked:focus:outline-primary active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark rounded-sm dark:bg-surface-dark-alt dark:checked:border-primary-dark dark:checked:before:bg-primary-dark dark:focus:outline-outline-dark-strong dark:checked:focus:outline-primary-dark"
                                x-on:change="handleOptionToggle($el)"
                                x-on:keydown.enter.prevent="$el.checked = !$el.checked; handleOptionToggle($el)"
                                x-bind:value="item.value"
                                x-bind:id="uuid + 'Option' + index"
                                x-bind:checked="selectedOptions.includes(item.value)"
                                {{ $attributes->only('disabled') }}
                            />
                            <!-- Checkmark  -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"
                                 fill="none" stroke-width="4"
                                 class="pointer-events-none invisible absolute left-1/2 top-1/2 size-3 -translate-x-1/2 -translate-y-1/2 text-on-primary peer-checked:visible dark:text-on-primary-dark"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <span x-text="item.label"></span>
                    </label>
                </li>
            </template>
        </ul>
    </div>

    @if($hint)
        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
