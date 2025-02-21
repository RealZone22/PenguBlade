@props([
    'placement' => 'right',
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
])

<div x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
    <label x-bind:for="uuid" class="inline-flex cursor-pointer items-center gap-3">
        <input x-bind:id="uuid" type="checkbox"
               {{ $attributes->except('class')->merge(['class' => 'peer sr-only']) }} role="switch"/>

        @if($placement == 'left')
            <span
                class="trancking-wide text-sm font-medium text-neutral-600 peer-checked:text-neutral-900 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-neutral-300 dark:peer-checked:text-white">
            {{ $slot }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-red-600">*</span>
                @endif
        </span>
        @endif
        <div
            {{ $attributes->twMerge("relative h-6 w-11 after:h-5 after:w-5 peer-checked:after:translate-x-5 rounded-full bg-neutral-50 after:absolute after:bottom-0 after:left-[0.0625rem] after:top-0 after:my-auto after:rounded-full after:bg-neutral-600 after:transition-all after:content-[''] peer-checked:bg-black peer-checked:after:bg-neutral-100 peer-focus:outline peer-focus:outline-2 peer-focus:outline-offset-2 peer-focus:outline-neutral-800 peer-focus:peer-checked:outline-black peer-active:outline-offset-0 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:border-neutral-700 dark:bg-neutral-900 dark:after:bg-neutral-300 dark:peer-checked:bg-white dark:peer-checked:after:bg-black dark:peer-focus:outline-neutral-300 dark:peer-focus:peer-checked:outline-white") }}
            aria-hidden="true"></div>
        @if($placement == 'right')
            <span
                class="trancking-wide text-sm font-medium text-neutral-600 peer-checked:text-neutral-900 peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-neutral-300 dark:peer-checked:text-white">
            {{ $slot }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-red-600">*</span>
                @endif
        </span>
        @endif
    </label>

    @if($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
