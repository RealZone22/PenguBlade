@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'maxSize' => null,
    'showProgress' => false,
])

<div>
    <div class="relative flex w-full flex-col gap-1"
         x-data="{
            uuid: Math.random().toString(20).substring(2, 20),
            errorMessage: '',
            
            checkFileSize(event) {
                this.errorMessage = '';
                const file = event.target.files[0];
                const maxSize = {{ $maxSize ?? 'null' }};

                if (file && maxSize) {
                    const limit = maxSize * 1024;
                    if (file.size > limit) {
                        this.errorMessage = '{{ __("validation.max.file", ["max" => $maxSize]) }}';
                        event.target.value = '';
                    }
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


        <div class="relative">
            <input x-bind:id="uuid"
                   type="file"
                   @change="checkFileSize($event)"
                   @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                   {{ $attributes->twMerge('w-full overflow-clip rounded-radius border border-outline bg-surface-alt/50 text-sm text-on-surface file:mr-4 file:border-none file:bg-surface-alt file:px-4 file:py-2 file:font-medium file:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:file:bg-surface-dark-alt dark:file:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark') }}/>

            @if($showProgress)
                <div x-show="$wire?.uploadProgress || $wire?.uploadProgress === 0" x-cloak
                     class="absolute inset-0 flex items-center justify-center rounded-radius bg-surface/90 dark:bg-surface-dark/90 backdrop-blur-sm">
                    <div class="w-full max-w-md px-4">
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="text-on-surface/70 dark:text-on-surface-dark/70">
                                <span x-text="`${Math.round($wire.uploadProgress || 0)}%`"></span>
                            </span>
                        </div>
                        
                        <div class="flex h-2.5 w-full overflow-hidden rounded-radius bg-surface-alt dark:bg-surface-dark-alt"
                             role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="h-full bg-primary dark:bg-primary-dark transition-all duration-300 ease-out"
                                 x-bind:style="`width: ${$wire.uploadProgress || 0}%`"
                                 x-bind:aria-valuenow="$wire.uploadProgress || 0">
                                <span class="flex h-full items-center justify-center text-xs font-semibold text-white"
                                      x-show="($wire.uploadProgress || 0) > 10"
                                      x-text="`${Math.round($wire.uploadProgress || 0)}%`"></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

                @if($showValidation)
            <div class="text-danger text-sm">
                <span x-show="errorMessage" x-text="errorMessage" x-cloak></span>
                @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()))
                    <span x-show="!errorMessage" x-cloak>{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</span>
                @endif
            </div>
        @endif
            </div>

    @if($hint)
        <p class="text-on-surface/50 dark:text-on-surface-dark/50 text-xs mt-1">
            {{ $hint }}
        </p>
    @endif
</div>
