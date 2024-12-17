<div x-cloak x-show="isExpanded" :id="uuid" role="region" :aria-labelledby="uuid" x-collapse>
    <div {{ $attributes->twMerge('p-4 text-sm sm:text-base text-pretty') }}>
        {{ $slot }}
    </div>
</div>
