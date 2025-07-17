@props([
    'label' => null,
    'showIcon' => 'icon-eye',
    'hideIcon' => 'icon-eye-off',
    'hint' => null,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
    'showGenerate' => false,
    'showToggle' => true,
    'showPassword' => false,
    // Generator Rules
    'withNumbers' => true,
    'withSpecialChars' => true,
    'withUpper' => true,
    'withLower' => true,
    'length' => 16,
])

<div class="flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark"
     x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
    @if($label)
        <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
            {{ $label }}

            @if($attributes->get('required') && $showRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <div x-data="{
        showPassword: {{ $showPassword ? 'true' : 'false' }},
        withUpper: {{ $withUpper ? 'true' : 'false' }},
        withLower: {{ $withLower ? 'true' : 'false' }},
        withNumbers: {{ $withNumbers ? 'true' : 'false' }},
        withSpecialChars: {{ $withSpecialChars ? 'true' : 'false' }},
        passwordLength: {{ $length }},
        generatePassword() {
            const input = document.getElementById(this.uuid);
            let chars = '';

            if (this.withUpper) {
                chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            }

            if (this.withLower) {
                chars += 'abcdefghijklmnopqrstuvwxyz';
            }

            if (this.withNumbers) {
                chars += '0123456789';
            }

            if (this.withSpecialChars) {
                chars += '!@#$%^&*()_-+=<>?';
            }

            if (chars === '') {
                chars = 'abcdefghijklmnopqrstuvwxyz';
            }

            let password = '';
            for (let i = 0; i < this.passwordLength; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            input.value = password;
            input.dispatchEvent(new Event('input'));
        }
    }" class="relative">
        <input x-bind:type="showPassword ? 'text' : 'password'" x-bind:id="uuid"
               @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            {{ $attributes->merge(['class' => 'w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark', 'autocomplete' => 'current-password']) }}/>

        @if($showToggle)
            <button type="button" x-on:click="showPassword = !showPassword"
                    class="cursor-pointer absolute right-2.5 top-1/2 -translate-y-1/2 text-on-surface dark:text-on-surface-dark"
                    aria-label="Show password">
                <i class="{{ $showIcon }}" x-show="!showPassword"></i>
                <i class="{{ $hideIcon }}" x-show="showPassword"></i>
            </button>
        @endif
        @if($showGenerate)
            <button type="button" x-on:click="generatePassword()"
                    class="cursor-pointer absolute @if($showToggle) right-8 @else right-2.5 @endif top-1/2 -translate-y-1/2 text-on-surface dark:text-on-surface-dark"
                    aria-label="Generate password">
                <i class="icon-refresh-ccw"></i>
            </button>
        @endif
    </div>

    @if($hint)
        <p class="mt-1 text-sm text-on-surface dark:text-on-surface-dark">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
