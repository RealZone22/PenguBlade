@props([
    'label' => null,
    'selectText' => 'Please Select',
    'options' => [],
])

<div x-data="{
        uuid: Math.random().toString(20).substring(2, 20),
        options: {{ json_encode($options) }},
        isOpen: false,
        openedWithKeyboard: false,
        selectedOptions: @entangle($attributes->wire('model')),
        setLabelText() {
            const count = this.selectedOptions?.length || 0;

            // if there are no selected options
            if (count === 0) return '{{ $selectText }}';

            // join the selected options with a comma
            return this.selectedOptions.join(', ');
        },
        highlightFirstMatchingOption(pressedKey) {
            if (pressedKey === 'Enter') return;

            // find and focus the option that starts with the pressed key
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
            // Ensure `selectedOptions` is an array
            if (!Array.isArray(this.selectedOptions)) {
                this.selectedOptions = [];
            }

            if (option.checked) {
                this.selectedOptions = [...this.selectedOptions, option.value];
            } else {
                this.selectedOptions = this.selectedOptions.filter(
                    (opt) => opt !== option.value,
                );
            }
        },
    }" class="w-full max-w-xs flex flex-col gap-1"
     x-on:keydown="highlightFirstMatchingOption($event.key)"
     x-on:keydown.esc.window="isOpen = false, openedWithKeyboard = false">
    <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm text-neutral-600 dark:text-neutral-300">
        {{ $label }}
    </label>
    <div class="relative">

        {{ $slot }}

        <!-- Bind the hidden input to the selectedOptions array -->
        <input x-bind:id="uuid" type="hidden" x-ref="hiddenTextField"
               :value="JSON.stringify(selectedOptions)"/>
    </div>
</div>
