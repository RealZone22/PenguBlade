@props([
    'position' => 'bottom',
])

<div x-cloak
     x-show="isOpen || openedWithKeyboard"
     x-transition
     x-trap="openedWithKeyboard"
     x-on:click.outside="isOpen = false, openedWithKeyboard = false"
     x-on:keydown.down.prevent="$focus.wrap().next()"
     x-on:keydown.up.prevent="$focus.wrap().previous()"
     x-init="(() => {
        const updatePosition = () => {
            if (isOpen || openedWithKeyboard) {
                const trigger = $el.previousElementSibling;
                const rect = trigger.getBoundingClientRect();

                $el.style.position = 'fixed';
                $el.style.zIndex = '50';
                $el.style.width = 'max-content';
                $el.style.minWidth = Math.max($el.offsetWidth, rect.width) + 'px';

                if ('{{ $position }}' === 'top') {
                    $el.style.bottom = (window.innerHeight - rect.top) + 'px';
                    $el.style.left = rect.left + 'px';
                } else if ('{{ $position }}' === 'bottom') {
                    $el.style.top = rect.bottom + 'px';
                    $el.style.left = rect.left + 'px';
                } else if ('{{ $position }}' === 'left') {
                    $el.style.top = rect.top + 'px';
                    $el.style.right = (window.innerWidth - rect.left) + 'px';
                } else if ('{{ $position }}' === 'right') {
                    $el.style.top = rect.top + 'px';
                    $el.style.left = rect.right + 'px';
                }
            }
        };

        $watch('isOpen', value => {
            if (value) setTimeout(updatePosition, 10);
        });
        $watch('openedWithKeyboard', value => {
            if (value) setTimeout(updatePosition, 10);
        });

        window.addEventListener('resize', updatePosition);
        window.addEventListener('scroll', updatePosition, true);
     })()"
     {{ $attributes->twMerge('fixed flex flex-col overflow-hidden rounded-radius border border-outline bg-surface-alt dark:border-outline-dark dark:bg-surface-dark-alt') }}
     role="menu">
    {{ $slot }}
</div>
