<div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
    <table {{ $attributes->twMerge('w-full text-left text-sm text-on-surface dark:text-on-surface-dark') }}>
        {{ $slot }}
    </table>
</div>
