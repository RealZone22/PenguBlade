@props([
    'uuid' => 'pengublade-radio-' . str()->uuid(),
    'hint' => null,
])

<div
    class="flex items-center justify-start gap-2 font-medium text-neutral-600 has-[:disabled]:opacity-75 dark:text-neutral-300">
    <input id="{{ $uuid }}" type="radio"
        {{ $attributes->twMerge("before:content[''] cursor-pointer relative h-4 w-4 appearance-none rounded-full bg-neutral-50 before:invisible before:absolute before:left-1/2 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-x-1/2 before:-translate-y-1/2 before:rounded-full before:bg-neutral-100 checked:bg-black checked:before:visible focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-neutral-800 checked:focus:outline-black disabled:cursor-not-allowed dark:bg-neutral-900 dark:before:bg-black dark:checked:bg-white dark:focus:outline-neutral-300 dark:checked:focus:outline-white") }}>
    <label for="{{ $uuid }}" class="text-sm cursor-pointer">
        {{ $slot }}
    </label>
</div>

@if($hint)
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
@endif

@if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
    <div class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
@endif
