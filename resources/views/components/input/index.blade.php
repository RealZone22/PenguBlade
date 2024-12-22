@props([
    'uuid' => 'pengublade-rating-' . str()->uuid(),
    'hint' => null,
])

<div class="flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-300">
    <label for="{{ $uuid }}" class="w-fit pl-0.5 text-sm">
        {{ $slot }}
    </label>
    <input
        id="{{ $uuid }}" {{ $attributes->twMerge('w-full rounded-md bg-neutral-50 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-900/50 dark:focus-visible:outline-white') }}/>
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
