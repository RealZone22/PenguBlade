@props([
    'defaultOpen' => false,
])

<div x-data="{modalIsOpen: {{ $defaultOpen }}}">
    {{ $slot }}
</div>
