@props([
    'openWithClick' => 'left',
])

<?php

$openWithClickCode = match ($openWithClick) {
    'both' => 'x-on:click="isOpen = ! isOpen" x-on:contextmenu.prevent="isOpen = true"',
    'right' => 'x-on:contextmenu.prevent="isOpen = true"',
    default => 'x-on:click="isOpen = ! isOpen"',
};

?>

<div type="button"
     x-on:keydown.down.prevent="openedWithKeyboard = true"
     x-on:keydown.enter.prevent="openedWithKeyboard = true"
     x-on:keydown.space.prevent="openedWithKeyboard = true"
     {!! $openWithClickCode !!}
     aria-haspopup="true">
    {{ $slot }}
</div>
