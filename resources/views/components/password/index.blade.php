@props([
    'showIcon' => 'icon-eye',
    'hideIcon' => 'icon-eye-off',
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
])

<div x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
    <div class="flex w-full flex-col gap-1 text-neutral-600 dark:text-neutral-300">
        <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
            {{ $slot }}

            @if($attributes->get('required') && $showRequired)
                <span class="text-red-600">*</span>
            @endif
        </label>
        <div x-data="{ showPassword: false }" class="relative">
            <input :type="showPassword ? 'text' : 'password'"
                   x-bind:id="uuid" {{ $attributes->twMerge('w-full rounded-md border border-neutral-300 bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:focus-visible:outline-white') }}/>
            <button type="button" @click="showPassword = !showPassword"
                    class="absolute right-2.5 top-1/2 -translate-y-1/2 text-neutral-600 dark:text-neutral-300"
                    aria-label="Show password">
                <i class="{{ $showIcon }}" x-show="!showPassword"></i>
                <i class="{{ $hideIcon }}" x-show="showPassword"></i>
            </button>
        </div>
    </div>

    @if($hint)
        <p class="text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
