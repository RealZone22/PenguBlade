@props([
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
])

<div>
    <div class="relative flex w-full flex-col gap-1" x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
        <label class="w-fit pl-0.5 text-sm text-neutral-600 dark:text-neutral-300" x-bind:for="uuid">
            {{ $slot }}

            @if($attributes->get('required') && $showRequired)
                <span class="text-red-600">*</span>
            @endif
        </label>
        <input x-bind:id="uuid" type="file"
            {{ $attributes->twMerge('w-full overflow-clip rounded-md border border-neutral-300 bg-neutral-50/50 text-sm text-neutral-600 file:mr-4 file:cursor-pointer file:border-none file:bg-neutral-50 file:px-4 file:py-2 file:font-medium file:text-neutral-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:border-neutral-700 dark:bg-neutral-900/50 dark:text-neutral-300 dark:file:bg-neutral-900 dark:file:text-white dark:focus-visible:outline-white') }}/>
    </div>

    @if($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
