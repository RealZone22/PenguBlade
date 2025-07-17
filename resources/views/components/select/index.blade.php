@props([
    'label' => null,
    'hint' => null,
    'uuid' => null,
    'icon' => null,
    'tooltip' => null,
    'showRequired' => true,
    'showValidation' => true,
])

<div x-data="{ uuid: '{{ $uuid }}' ? '{{ $uuid }}' : Math.random().toString(20).substring(2, 20) }">
    <div class="relative flex w-full flex-col gap-1 text-on-surface dark:text-on-surface-dark">
        @if($label)
            <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif
        @if($icon)
            <i class="{{ $icon }} absolute pointer-events-none right-2 top-2 size-5"></i>
        @endif
            <select x-bind:id="uuid" @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                {{ $attributes->twMerge('w-full cursor-pointer appearance-none rounded-radius border border-outline bg-surface-alt pr-5 pl-4 py-2 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:focus-visible:outline-primary-dark') }}>
            {{ $slot }}
        </select>
    </div>

    @if($hint)
        <p class="mt-1 text-sm text-on-surface dark:text-on-surface-dark">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
