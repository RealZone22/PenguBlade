@props([
    'type' => 'sent',
    'typing' => false,
    'footer' => null,
    'title' => null,
    'avatar' => null,
    'tooltip' => null,
])

@if($type == 'sent')
    @if($avatar)
        <div class="flex items-end gap-2">
            <div
                class="ml-auto flex max-w-[70%] flex-col gap-2 rounded-l-radius rounded-tr-radius bg-primary p-4 text-sm text-on-primary md:max-w-[60%] dark:bg-primary-dark dark:text-on-primary-dark"
                @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
                {{ $slot }}
                @if($footer)
                    <span class="ml-auto text-xs">{{ $footer }}</span>
                @endif
            </div>
            {{ $avatar }}
        </div>
    @else
        <div
            class="ml-auto flex max-w-[80%] flex-col gap-2 rounded-l-radius rounded-tr-radius bg-primary p-4 text-sm text-on-primary md:max-w-[60%] dark:bg-primary-dark dark:text-on-primary-dark"
            @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
            {{ $slot }}
            @if($footer)
                <span class="ml-auto text-xs">{{ $footer }}</span>
            @endif
        </div>
    @endif
@elseif($type == 'received')
    @if($avatar)
        <div class="flex items-end gap-2">
            {{ $avatar }}
            <div
                class="mr-auto flex max-w-[70%] flex-col gap-2 rounded-r-radius rounded-tl-radius bg-surface-alt p-4 text-on-surface md:max-w-[60%] dark:bg-surface-dark-alt dark:text-on-surface-dark"
                @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
                @if($title)
                    <span
                        class="font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">{{ $title }}</span>
                @endif
                <div class="text-sm">
                    {{ $slot }}
                </div>
                @if($footer)
                    <span class="ml-auto text-xs">{{ $footer }}</span>
                @endif
            </div>
        </div>
    @else
        <div
            class="mr-auto flex max-w-[80%] flex-col gap-2 rounded-r-radius rounded-tl-radius bg-surface-alt p-4 md:max-w-[60%] dark:bg-surface-dark-alt">
            @if($title)
                <span class="font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">{{ $title }}</span>
            @endif
                <div class="text-sm text-on-surface dark:text-on-surface-dark" @if($tooltip) x-data
                     x-tooltip.raw="{{ $tooltip }}" @endif>
                {{ $slot }}
            </div>
            @if($footer)
                <span class="ml-auto text-xs">{{ $footer }}</span>
            @endif
        </div>
    @endif
@endif
