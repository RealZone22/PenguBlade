@props([
    'title' => null,
    'message' => null,
    'icon' => null,
    'type' => 'info',
    'tooltip' => null,
    'dismissible' => false,
    'dismissIcon' => 'icon-x',
])

<?php
$colorClass = match ($type) {
    'success' => 'bg-success/10',
    'warning' => 'bg-warning/10',
    'error' => 'bg-danger/10',
    default => 'bg-info/10',
};

$borderColorClass = match ($type) {
    'success' => 'border-green-500',
    'warning' => 'border-amber-500',
    'error' => 'border-red-500',
    default => 'border-sky-500',
};
?>

@if($dismissible)
    <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible" @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
         class="relative w-full overflow-hidden rounded-md border bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark {{ $borderColorClass }}"
         role="alert" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

        <div {{ $attributes->twMerge('flex w-full items-center gap-2 p-4 ' . $colorClass) }}>
            @if($icon)
                <div class="rounded-full p-1" aria-hidden="true">
                    <i class="{{ $icon }}"></i>
                </div>
            @endif
            @if($title || $message)
                <div class="ml-2">
                    @if($title)
                        <h3 class="text-sm font-semibold text-info">{{ $title }}</h3>
                    @endif
                    @if($message)
                        <p class="text-xs font-medium sm:text-sm">{{ $message }}</p>
                    @endif
                </div>
            @endif

            {{ $slot }}

            <button type="button" @click="alertIsVisible = false" class="ml-auto cursor-pointer"
                    aria-label="dismiss alert">
                <i class="{{ $dismissIcon }}"></i>
            </button>
        </div>
    </div>
@else
    <div @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
        class="relative w-full overflow-hidden rounded-md border bg-surface text-on-surface dark:bg-surface-dark dark:text-on-surface-dark {{ $borderColorClass }}"
        role="alert">
        <div {{ $attributes->twMerge('flex w-full items-center gap-2 p-4 ' . $colorClass) }}>
            @if($icon)
                <div class="rounded-full p-1" aria-hidden="true">
                    <i class="{{ $icon }}"></i>
                </div>
            @endif
            @if($title || $message)
                <div class="ml-2">
                    @if($title)
                        <h3 class="text-sm font-semibold text-info">{{ $title }}</h3>
                    @endif
                    @if($message)
                        <p class="text-xs font-medium sm:text-sm">{{ $message }}</p>
                    @endif
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>
@endif
