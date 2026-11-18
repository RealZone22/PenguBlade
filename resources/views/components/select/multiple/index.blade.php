@props([
    'label' => null,
    'placeholder' => __('pengublade::messages.select'),
    'name' => null,
    'hint' => null,
    'chevronIcon' => 'icon-chevron-right',
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'selectAllText' => __('pengublade::messages.select_all'),
    'deselectAllText' => __('pengublade::messages.deselect_all'),
    'noOptionsText' => __('pengublade::messages.no_options'),
    'value' => []
])

@php
    $uuid = $attributes->get('id') ?? 'multiselect-' . str()->random(8);
    $wireModel = $attributes->wire('model');
    $wireModelValue = $wireModel->value();
    $wireModelModifiers = $wireModel->modifiers()->toArray();
    $wireModelModifierString = !empty($wireModelModifiers) ? '.' . implode('.', $wireModelModifiers) : '';
    $inputName = $name ?? $wireModelValue ?? $uuid;
@endphp

<div
    x-data="{
        uuid: '{{ $uuid }}',
        isOpen: false,
        openedWithKeyboard: false,
        options: [],
        optionsObserver: null,
        selectedOptions: @if($wireModelValue) @entangle($wireModelValue){{ $wireModelModifierString }} @else {{ json_encode(array_map('strval', (array) $value)) }} @endif,
        position: { top: 0, left: 0, width: 0 },

        init() {
            this.parseOptions();
            this.updateHiddenInputs();

            this.optionsObserver = new MutationObserver(() => this.parseOptions());
            this.optionsObserver.observe(this.$refs.optionsSource, {
                childList: true,
                subtree: true,
                attributes: true,
                attributeFilter: ['disabled', 'value']
            });

            Livewire.hook('morph.updated', ({ el }) => {
                if (this.$el.contains(el) || this.$el === el) {
                    this.$nextTick(() => {
                        this.parseOptions();
                        this.updateHiddenInputs();

                        if (this.isOpen) {
                            this.updatePosition();
                        }
                    });
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

        updatePosition() {
            const trigger = this.$refs.trigger;
            if (!trigger) return;

            const rect = trigger.getBoundingClientRect();
            const listbox = this.$refs.listbox;
            const listboxHeight = listbox?.offsetHeight || 256;
            const opensUpward = rect.bottom + listboxHeight > window.innerHeight && rect.top - listboxHeight > 0;

            this.position = {
                top: opensUpward ? rect.top - listboxHeight - 4 : rect.bottom + 4,
                left: rect.left,
                width: rect.width
            };
        },

        openListbox(withKeyboard = false) {
            this.isOpen = true;
            this.openedWithKeyboard = withKeyboard;
            this.$nextTick(() => {
                this.updatePosition();

                if (withKeyboard) {
                    this.$refs.listbox?.querySelector('[role=option]')?.focus();
                }
            });
        },

        closeListbox() {
            this.isOpen = false;
            this.openedWithKeyboard = false;
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
    x-on:keydown.esc.window="closeListbox()"
    x-on:resize.window="if (isOpen) updatePosition()"
    x-on:scroll.window="if (isOpen) updatePosition()"
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
            x-ref="trigger"
            x-on:click.stop="isOpen ? closeListbox() : openListbox()"
            x-on:keydown.down.prevent="openListbox(true)"
            x-on:keydown.enter.prevent="openListbox(true)"
            x-on:keydown.space.prevent="openListbox(true)"
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
                x-bind:class="{ 'rotate-90': isOpen }"
            ></i>
        </button>

        <template x-teleport="body" wire:ignore>
            <div
                x-cloak
                x-show="isOpen || openedWithKeyboard"
                x-ref="listbox"
                x-bind:id="uuid + '-list'"
                x-bind:style="{ top: position.top + 'px', left: position.left + 'px', width: position.width + 'px' }"
                class="fixed z-50 flex max-h-64 flex-col overflow-hidden overflow-y-auto border-outline bg-surface-alt py-1.5 dark:border-outline-dark dark:bg-surface-dark-alt border rounded-radius shadow-lg"
                role="listbox"
                aria-multiselectable="true"
                x-on:click.outside="closeListbox()"
                x-on:keydown.escape.prevent="closeListbox()"
                x-on:keydown.tab="closeListbox()"
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
                            class="flex items-center cursor-pointer z-50 gap-2 px-4 py-2.5 text-sm text-on-surface hover:bg-surface-dark/5 focus:bg-surface-dark/5 focus:outline-none dark:text-on-surface-dark dark:hover:bg-surface/5 dark:focus:bg-surface/5"
                            x-bind:class="{
                                'opacity-50 cursor-not-allowed': item.disabled,
                                'bg-primary/10 dark:bg-primary-dark/10': isSelected(item.value)
                            }"
                        >
                            <div class="relative flex items-center justify-center z-50 size-4 shrink-0">
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
                     class="px-4 py-3 text-sm text-on-surface/50 dark:text-on-surface-dark/50 text-center">
                    {{ $noOptionsText }}
                </div>
            </div>
        </template>
    </div>

    @if($hint)
        <p class="text-on-surface/50 dark:text-on-surface-dark/50 text-xs mt-1">
            {{ $hint }}
        </p>
    @endif

    @if($showValidation)
        @error($wireModelValue ?? $inputName)
        <div class="text-danger text-sm mt-1">{{ $message }}</div>
        @enderror
    @endif
</div>
