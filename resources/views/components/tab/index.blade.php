<div x-data="{ selectedTab: @entangle($attributes->wire('model')) }" class="w-full">
    <div @keydown.right.prevent="$focus.wrap().next()" @keydown.left.prevent="$focus.wrap().previous()"
         {{ $attributes->twMerge('flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700') }} role="tablist"
         aria-label="tab options">
        {{ $slot }}
    </div>
</div>
