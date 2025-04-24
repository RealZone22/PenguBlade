@if(filled($slot))
    <div class="flex items-center my-4">
        <hr {{ $attributes->twMerge('border-t dark:border-outline-dark my-4') }}>
        <span class="mx-2 dark:text-on-surface-dark">{{ $slot }}</span>
        <hr {{ $attributes->twMerge('border-t dark:border-outline-dark my-4') }}>
    </div>
@else
    <hr {{ $attributes->twMerge('border-t dark:border-outline-dark my-4') }}>
@endif
