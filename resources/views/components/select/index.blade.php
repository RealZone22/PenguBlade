@props([
    'uuid' => 'pengublade-select-' . str()->uuid(),
    'label' => null,
    'hint' => null,
])

<div class="relative flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-300">
    @if($label)
        <label for="{{ $uuid }}" class="w-fit pl-0.5 text-sm">{{ $label }}</label>
    @endif
    <select id="{{ $uuid }}"
        {{ $attributes->twMerge('w-full appearance-none rounded-md bg-neutral-50 px-4 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-900/50 dark:focus-visible:outline-white') }}>
        {{ $slot }}
    </select>
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
