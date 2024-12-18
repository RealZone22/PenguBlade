@props([
    'dismissable' => false,
    'dismissIcon' => 'icon-x',
    'fixed' => false
])

@if($dismissable)
    <div x-data="{ bannerIsVisible: true }" x-show="bannerIsVisible"
         {{ $attributes->twMerge('relative flex bg-neutral-50 p-4 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300 ' . ($fixed ? 'fixed inset-x-0 top-0 z-10' : '')) }}
         role="alert" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        {{ $slot }}

        <button type="button" @click="bannerIsVisible = false" class="absolute top-1/2 -translate-y-1/2 right-4"
                aria-label="dismiss banner">
            <i class="{{ $dismissIcon }}"></i>
        </button>
    </div>
@else
    <div
        {{ $attributes->twMerge('relative flex bg-neutral-50 p-4 text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300 ' . ($fixed ? 'fixed inset-x-0 top-0 z-10' : '')) }}
        role="alert" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        {{ $slot }}
    </div>
@endif
