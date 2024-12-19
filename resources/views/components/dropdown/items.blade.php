@props([
    'position' => 'bottom',
])

<div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
     @click.outside="isOpen = false, openedWithKeyboard = false" @keydown.down.prevent="$focus.wrap().next()"
     @keydown.up.prevent="$focus.wrap().previous()"
     {{ $attributes->twMerge([
        'class' => 'flex min-w-[12rem] flex-col overflow-hidden rounded-md bg-neutral-50 py-1.5 dark:bg-neutral-900 ' .
                   ($position === 'top' ? 'absolute bottom-11' : '') .
                   ($position === 'bottom' ? 'absolute top-11 left-0' : '') .
                   ($position === 'left' ? 'absolute right-full mr-1 top-0' : '') .
                   ($position === 'right' ? 'absolute left-full ml-1 top-0' : '')
    ]) }}
     role="menu">
    {{ $slot }}
</div>
