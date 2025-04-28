@props([
    'position' => 'bottom',
])

<?php

$positionClass = match ($position) {
    'top' => 'bottom-11',
    'bottom' => 'top-11 left-0',
    'left' => 'right-full mr-1 top-0 flex',
    'right' => 'left-full ml-1 top-0',
};

?>

<div x-cloak x-show="isOpen || openedWithKeyboard" x-transition x-trap="openedWithKeyboard"
     x-on:click.outside="isOpen = false, openedWithKeyboard = false" x-on:keydown.down.prevent="$focus.wrap().next()"
     x-on:keydown.up.prevent="$focus.wrap().previous()"
     {{ $attributes->twMerge('absolute flex w-fit min-w-48 flex-col overflow-hidden rounded-radius border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt ' . $positionClass) }}
     role="menu">
    {{ $slot }}
</div>
