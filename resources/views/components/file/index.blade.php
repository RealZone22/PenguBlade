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
         x-on:livewire-upload-start="uploading = true" 
         x-on:livewire-upload-finish="uploading = false" 
         x-on:livewire-upload-cancel="uploading = false" 
         x-on:livewire-upload-error="uploading = false" 
         x-on:livewire-upload-progress="progress = $event.detail.progress"
         x-data="{
            uuid: Math.random().toString(20).substring(2, 20),
            errorMessage: '',
            uploading: false,
            progress: 0,
            
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
                <div class="mt-1" x-show="uploading" x-cloak>
                    <div class="flex h-2.5 w-full overflow-hidden rounded-radius bg-surface-alt dark:bg-surface-dark-alt">
                        <div class="h-full bg-primary transition-all duration-500 ease-out dark:bg-primary-dark" 
                             x-bind:style="'width: ' + progress + '%'">
                        </div>
                    </div>
                    <div class="text-right text-xs mt-1 text-on-surface/50 dark:text-on-surface-dark/50">
                        <span x-text="progress + '%'"></span>
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
