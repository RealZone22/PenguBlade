@if(filled($slot))
    <div class="flex items-center my-4">
        <hr {{ $attributes->twMerge('border-t border-neutral-300 dark:border-neutral-700 my-4') }}>
        <span class="mx-2 text-neutral-600 dark:text-neutral-300">{{ $slot }}</span>
        <hr {{ $attributes->twMerge('border-t border-neutral-300 dark:border-neutral-700 my-4') }}>
    </div>
@else
    <hr {{ $attributes->twMerge('border-t border-neutral-300 dark:border-neutral-700 my-4') }}>
@endif
