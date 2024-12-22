<div x-data="{ isOpen: false, openedWithKeyboard: false }"
     {{ $attributes->twMerge('relative') }} @keydown.esc.window="isOpen = false, openedWithKeyboard = false">
    {{ $slot }}
</div>
