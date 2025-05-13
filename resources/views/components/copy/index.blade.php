@props([
    'copyIcon' => 'icon-clipboard',
    'copiedIcon' => 'icon-check',
    'text' => null,
    'tooltip' => null,
])

<div x-data="{
    copiedToClipboard: false,
    copyToClipboard() {
        navigator.clipboard
        .writeText('{{ $text }}')
        .then(() => {
            this.copiedToClipboard = true
        })
        .catch((err) => {
            this.copiedToClipboard = false
        })
    },
}"
     class="flex flex-col gap-4">
    <button @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
        class="rounded-full cursor-pointer w-fit text-on-surface/75 focus:outline-hidden focus-visible:text-on-surface focus-visible:outline-offset-0 focus-visible:outline-primary active:bg-surface-dark/5 active:-outline-offset-2 dark:text-on-surface-dark/75 dark:focus-visible:text-on-surface-dark dark:focus-visible:outline-primary-dark dark:active:bg-surface/5"
        title="Copy" aria-label="Copy" x-on:click="copyToClipboard()" x-on:click.away="copiedToClipboard = false">
        <span class="sr-only" x-text="copiedToClipboard ? 'copied' : 'copy the response to clipboard'"></span>
        <i x-show="!copiedToClipboard" class="{{ $copyIcon }} size-4"></i>
        <i x-show="copiedToClipboard" class="{{ $copiedIcon }} size-4 text-success"></i>
    </button>

</div>
