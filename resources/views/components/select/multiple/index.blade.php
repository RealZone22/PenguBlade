@props([
    'label' => null,
    'placeholder' => __('Select options...'),
    'name' => null,
    'hint' => null,
    'chevronIcon' => 'icon-chevron-down',
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'selectAllText' => __('Select All'),
    'deselectAllText' => __('Deselect All'),
    'value' => []
])

@php
    $uuid = $attributes->get('id') ?? 'multiselect-' . str()->random(8);
    $wireModel = $attributes->wire('model')->value();
    $inputName = $name ?? $wireModel ?? $uuid;
@endphp

<div
    x-data="{
        uuid: '{{ $uuid }}',
        isOpen: false,
        openedWithKeyboard: false,
        options: [],
        selectedOptions: @if($wireModel) @entangle($wireModel) @else {{ json_encode(array_map('strval', (array) $value)) }} @endif,

        init() {
            this.parseOptions();
            this.updateHiddenInputs();

            Livewire.hook('morph.updated', ({ el }) => {
                if (this.$el.contains(el) || this.$el === el) {
                    this.$nextTick(() => this.parseOptions());
                }
            });
        },

        parseOptions() {
            const optionElements = this.$refs.optionsSource?.querySelectorAll('option');
            if (!optionElements) return;

            const parsed = [];
            optionElements.forEach(opt => {
                parsed.push({
                    value: opt.value,
                    label: opt.textContent.trim(),
                    disabled: opt.disabled
                });
            });
            this.options = parsed;
        },

        setLabelText() {
            if (!Array.isArray(this.selectedOptions) || this.selectedOptions.length === 0) {
                return '{{ $placeholder }}';
            }

            return this.selectedOptions.map(value => {
                const option = this.options.find(opt => String(opt.value) === String(value));
                return option ? option.label : value;
            }).join(', ');
        },

        isSelected(value) {
            if (!Array.isArray(this.selectedOptions)) return false;
            return this.selectedOptions.map(String).includes(String(value));
        },

        toggleOption(value, disabled) {
            if (disabled) return;

            if (!Array.isArray(this.selectedOptions)) {
                this.selectedOptions = [];
            }

            const stringValue = String(value);
            const index = this.selectedOptions.map(String).indexOf(stringValue);

            if (index > -1) {
                this.selectedOptions = this.selectedOptions.filter((_, i) => i !== index);
            } else {
                this.selectedOptions = [...this.selectedOptions, stringValue];
            }

            this.updateHiddenInputs();
            this.$dispatch('change', { value: this.selectedOptions });
        },

        updateHiddenInputs() {
            const container = this.$refs.hiddenInputs;
            if (!container) return;
            container.innerHTML = '';

            if (Array.isArray(this.selectedOptions)) {
                this.selectedOptions.forEach(value => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = '{{ $inputName }}[]';
                    input.value = value;
                    container.appendChild(input);
                });
            }
        },

        highlightFirstMatchingOption(pressedKey) {
            if (pressedKey.length !== 1) return;

            const option = this.options.find(item =>
                item.label.toLowerCase().startsWith(pressedKey.toLowerCase())
            );

            if (option) {
                const index = this.options.indexOf(option);
                const allOptions = this.$refs.listbox?.querySelectorAll('[role=option]');
                if (allOptions?.[index]) {
                    allOptions[index].focus();
                }
            }
        },

        selectAll() {
            this.selectedOptions = this.options
                .filter(opt => !opt.disabled)
                .map(opt => String(opt.value));
            this.updateHiddenInputs();
            this.$dispatch('change', { value: this.selectedOptions });
        },

        deselectAll() {
            this.selectedOptions = [];
            this.updateHiddenInputs();
            this.$dispatch('change', { value: this.selectedOptions });
        }
    }"
    wire:ignore.self
    {{ $attributes->only('class')->twMerge('w-full flex flex-col relative') }}
    x-on:keydown="highlightFirstMatchingOption($event.key)"
    x-on:keydown.esc.window="isOpen = false; openedWithKeyboard = false"
>
    {{-- Hidden select for parsing options --}}
    <select x-ref="optionsSource" class="hidden" aria-hidden="true">
        {{ $slot }}
    </select>

    {{-- Hidden inputs for form submission --}}
    <div x-ref="hiddenInputs" wire:ignore></div>

    @if($label)
        <label for="{{ $uuid }}" class="w-fit pl-0.5 text-sm text-on-surface dark:text-on-surface-dark">
            {{ $label }}
            @if($attributes->get('required') && $showRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <button
            @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            type="button"
            role="combobox"
            id="{{ $uuid }}"
            class="inline-flex w-full cursor-pointer items-center justify-between gap-2 whitespace-nowrap border-outline bg-surface-alt px-4 py-2 text-sm font-medium tracking-wide text-on-surface transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:focus-visible:outline-primary-dark border rounded-radius disabled:opacity-75 disabled:cursor-not-allowed"
            aria-haspopup="listbox"
            x-bind:aria-controls="uuid + '-list'"
            x-on:click="isOpen = !isOpen"
            x-on:keydown.down.prevent="isOpen = true; openedWithKeyboard = true; $nextTick(() => $refs.listbox?.querySelector('[role=option]')?.focus())"
            x-on:keydown.enter.prevent="isOpen = true; openedWithKeyboard = true"
            x-on:keydown.space.prevent="isOpen = true; openedWithKeyboard = true"
            x-bind:aria-label="setLabelText()"
            x-bind:aria-expanded="isOpen || openedWithKeyboard"
            {{ $attributes->only('disabled') }}
        >
            <span
                class="text-sm w-full font-normal text-start overflow-hidden text-ellipsis whitespace-nowrap"
                x-text="setLabelText()"
            ></span>
            <i
                class="{{ $chevronIcon }} size-5 transition-transform duration-200"
                x-bind:class="{ 'rotate-180': isOpen }"
            ></i>
        </button>

        <div
            x-cloak
            x-show="isOpen || openedWithKeyboard"
            x-ref="listbox"
            x-bind:id="uuid + '-list'"
            class="absolute z-50 mt-1 w-full flex max-h-64 flex-col overflow-hidden overflow-y-auto border-outline bg-surface-alt py-1.5 dark:border-outline-dark dark:bg-surface-dark-alt border rounded-radius shadow-lg"
            role="listbox"
            aria-multiselectable="true"
            x-on:click.outside="isOpen = false; openedWithKeyboard = false"
            x-on:keydown.escape.prevent="isOpen = false; openedWithKeyboard = false"
            x-on:keydown.tab="isOpen = false; openedWithKeyboard = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <div
                class="flex items-center justify-between px-4 py-2 border-b border-outline dark:border-outline-dark bg-surface-alt dark:bg-surface-dark-alt">
                <button
                    type="button"
                    class="text-xs text-primary hover:underline dark:text-primary-dark cursor-pointer"
                    x-on:click.prevent.stop="selectAll()"
                >
                    {{ $selectAllText }}
                </button>
                <button
                    type="button"
                    class="text-xs text-primary hover:underline dark:text-primary-dark cursor-pointer"
                    x-on:click.prevent.stop="deselectAll()"
                >
                    {{ $deselectAllText }}
                </button>
            </div>

            <div class="flex flex-col" x-show="options.length > 0">
                <template x-for="(item, index) in options" :key="'option-' + index + '-' + item.value">
                    <div
                        role="option"
                        tabindex="0"
                        x-bind:aria-selected="isSelected(item.value)"
                        x-bind:aria-disabled="item.disabled"
                        x-on:click="toggleOption(item.value, item.disabled)"
                        x-on:keydown.enter.prevent="toggleOption(item.value, item.disabled)"
                        x-on:keydown.space.prevent="toggleOption(item.value, item.disabled)"
                        x-on:keydown.down.prevent="$el.nextElementSibling?.focus()"
                        x-on:keydown.up.prevent="$el.previousElementSibling?.focus()"
                        class="flex items-center cursor-pointer gap-2 px-4 py-2.5 text-sm text-on-surface hover:bg-surface-dark/5 focus:bg-surface-dark/5 focus:outline-none dark:text-on-surface-dark dark:hover:bg-surface/5 dark:focus:bg-surface/5"
                        x-bind:class="{
                            'opacity-50 cursor-not-allowed': item.disabled,
                            'bg-primary/10 dark:bg-primary-dark/10': isSelected(item.value)
                        }"
                    >
                        <div class="relative flex items-center justify-center size-4 shrink-0">
                            <div
                                class="size-4 border rounded-sm transition-colors"
                                x-bind:class="isSelected(item.value)
                                    ? 'border-primary bg-primary dark:border-primary-dark dark:bg-primary-dark'
                                    : 'border-outline dark:border-outline-dark bg-surface-alt dark:bg-surface-dark-alt'"
                            ></div>
                            <svg
                                x-show="isSelected(item.value)"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                fill="none"
                                stroke-width="4"
                                class="absolute size-2.5 text-on-primary dark:text-on-primary-dark"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <span x-text="item.label" class="select-none"></span>
                    </div>
                </template>
            </div>

            <div x-show="options.length === 0"
                 class="px-4 py-3 text-sm text-gray-500 dark:text-neutral-400 text-center">
                {{ __('No options available') }}
            </div>
        </div>
    </div>

    @if($hint)
        <p class="text-on-surface dark:text-on-surface-dark text-xs mt-1">
            {{ $hint }}
        </p>
    @endif

    @if($showValidation)
        @error($wireModel ?? $inputName)
        <div class="text-danger text-sm mt-1">{{ $message }}</div>
        @enderror
    @endif
</div>
