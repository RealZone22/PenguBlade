@props([
    'type' => 'sent',
    'footer' => null,
    'avatar' => null,
])

@if($type == 'sent')
    @if($avatar)
        <div class="flex items-end gap-2">
            @endif
            <div {{ $attributes->twMerge('ml-auto flex max-w-[80%] flex-col gap-2 rounded-l-xl rounded-tr-xl bg-black p-4 text-sm text-neutral-100 md:max-w-[60%] dark:bg-white dark:text-black') }}>
                {{ $slot }}

                <span class="ml-auto text-xs">{{ $footer }}</span>
            </div>
            @if($avatar)
                <img class="size-8 rounded-full object-cover" src="{{ $avatar }}" alt="avatar"/>
        </div>
    @endif
@elseif($type == 'received')
    @if($avatar)
        <div class="flex items-end gap-2">
            <img class="size-8 rounded-full object-cover" src="{{ $avatar }}" alt="avatar"/>
            @endif
            <div {{ $attributes->twMerge('mr-auto flex max-w-[80%] flex-col gap-2 rounded-r-md rounded-tl-md bg-neutral-50 p-4 text-neutral-900 md:max-w-[60%] dark:bg-neutral-900 dark:text-white') }}>
                <div class="text-sm text-neutral-600 dark:text-neutral-300">
                    {{ $slot }}
                </div>
                <span class="ml-auto text-xs">{{ $footer }}</span>
            </div>
            @if($avatar)
        </div>
    @endif
@endif
