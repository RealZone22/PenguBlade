@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'icon' => null,
    'tooltip' => null,
])

<div x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
    <div class="@if($icon) relative @endif flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark">
        @if($label)
            <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif
        @if($icon)
            <i class="{{ $icon }} absolute left-2.5 top-1/2 text-gray-500 dark:text-neutral-500"></i>
        @endif
            <input @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            x-bind:id="uuid" {{ $attributes->twMerge('w-full rounded-radius border border-outline bg-surface-alt px-2 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark ' . ($icon ? 'pl-10' : '')) }}/>
    </div>

    @if($hint)
        <p class="text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
