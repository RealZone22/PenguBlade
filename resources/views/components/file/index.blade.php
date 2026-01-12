@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'maxSize' => 2048, // KB cinsinden varsayılan limit (2MB)
])

<div>
    <div class="relative flex w-full flex-col gap-1"
         x-data="{
            uuid: Math.random().toString(20).substring(2, 20),
            checkFileSize(event) {
                const file = event.target.files[0];
                const limit = {{ $maxSize }} * 1024; // KB'ı Byte'a çeviriyoruz
                if (file && file.size > limit) {
                    alert('File is too large! Maximum size allowed is {{ $maxSize }}KB.');
                    event.target.value = ''; // Seçimi temizle
                }
            }
         }">
        @if($label)
            <label class="w-fit pl-0.5 text-sm text-on-surface dark:text-on-surface-dark" x-bind:for="uuid">
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif


        <input x-bind:id="uuid"
               type="file"
               @change="checkFileSize($event)"
               @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
            {{ $attributes->twMerge('w-full overflow-clip rounded-radius border border-outline bg-surface-alt/50 text-sm text-on-surface file:mr-4 file:border-none file:bg-surface-alt file:px-4 file:py-2 file:font-medium file:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:file:bg-surface-dark-alt dark:file:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark') }}/>
    </div>

    @if($hint)
        <p class="text-on-surface/50 dark:text-on-surface-dark/50 text-xs mt-1">
            {{ $hint }}
        </p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-danger text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
