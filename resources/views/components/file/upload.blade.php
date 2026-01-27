@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
    'tooltip' => null,
    'maxSize' => null,
    'multiple' => false,
    'accept' => null,
    'showProgress' => true,
    'progressColor' => 'primary',
    'progressText' => true,
])

<div>
    <div class="relative flex w-full flex-col gap-1"
         x-data="{
            uuid: Math.random().toString(20).substring(2, 20),
            errorMessage: '',
            isUploading: false,
            uploadProgress: 0,
            uploadStartTime: null,
            files: [],
            
            checkFileSize(event) {
                this.errorMessage = '';
                const files = Array.from(event.target.files);
                const maxSize = {{ $maxSize ?? 'null' }};

                if (maxSize) {
                    const limit = maxSize * 1024;
                    const oversizedFiles = files.filter(file => file.size > limit);
                    
                    if (oversizedFiles.length > 0) {
                        this.errorMessage = oversizedFiles.length === 1 
                            ? '{{ __("validation.max.file", ["max" => $maxSize]) }}'
                            : '{{ __("validation.max.file_multiple", ["count" => ":count"]) }}';
                        event.target.value = '';
                        return false;
                    }
                }
                
                this.files = files;
                return true;
            },
            
            simulateUploadProgress() {
                // For non-Livewire uploads, simulate progress
                if (!this.hasWireModel) {
                    this.isUploading = true;
                    this.uploadProgress = 0;
                    this.uploadStartTime = Date.now();
                    
                    const interval = setInterval(() => {
                        if (this.uploadProgress < 90) {
                            this.uploadProgress += Math.random() * 15;
                        } else {
                            clearInterval(interval);
                            // Complete upload after a short delay
                            setTimeout(() => {
                                this.uploadProgress = 100;
                                setTimeout(() => {
                                    this.isUploading = false;
                                    this.uploadProgress = 0;
                                }, 500);
                            }, 200);
                        }
                    }, 100);
                }
            },
            
            handleFileChange(event) {
                if (this.checkFileSize(event)) {
                    this.simulateUploadProgress();
                }
            },
            
            get hasWireModel() {
                return {{ $attributes->whereStartsWith('wire:model')->first() ? 'true' : 'false' }};
            },
            
            get uploadSpeed() {
                if (!this.uploadStartTime || !this.isUploading) return 0;
                const elapsed = (Date.now() - this.uploadStartTime) / 1000;
                const avgFile = this.files.reduce((sum, file) => sum + file.size, 0) / this.files.length;
                return Math.round((avgFile * this.uploadProgress / 100) / elapsed / 1024);
            },
            
            get timeRemaining() {
                if (!this.uploadStartTime || !this.isUploading || this.uploadProgress >= 100) return 0;
                const elapsed = (Date.now() - this.uploadStartTime) / 1000;
                const avgSpeed = (this.files.reduce((sum, file) => sum + file.size, 0) / this.files.length) / elapsed / 1024;
                const remainingBytes = (this.files.reduce((sum, file) => sum + file.size, 0) / this.files.length) * (1 - this.uploadProgress / 100);
                return Math.round(remainingBytes / 1024 / avgSpeed);
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
                   @if($multiple) multiple @endif
                   @if($accept) accept="{{ $accept }}" @endif
                   @change="handleFileChange($event)"
                   @if($tooltip) x-tooltip.raw="{{ $tooltip }}" @endif
                   {{ $attributes->twMerge('w-full overflow-clip rounded-radius border border-outline bg-surface-alt/50 text-sm text-on-surface file:mr-4 file:border-none file:bg-surface-alt file:px-4 file:py-2 file:font-medium file:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary disabled:cursor-not-allowed disabled:opacity-75 dark:border-outline-dark dark:bg-surface-dark-alt/50 dark:text-on-surface-dark dark:file:bg-surface-dark-alt dark:file:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark') }}/>

            @if($showProgress)
                <div x-show="isUploading || uploadProgress > 0" x-cloak
                     class="absolute inset-0 flex items-center justify-center rounded-radius bg-surface/90 dark:bg-surface-dark/90 backdrop-blur-sm">
                    <div class="w-full max-w-md px-4">
                        <div class="mb-2 flex items-center justify-between text-sm">
                            <span class="text-on-surface dark:text-on-surface-dark">
                                @if($multiple)
                                    <span x-text="`${files.length} files`"></span>
                                @else
                                    <span x-text="files[0]?.name || 'Uploading...'"></span>
                                @endif
                            </span>
                            <span class="text-on-surface/70 dark:text-on-surface-dark/70">
                                <span x-text="`${Math.round(uploadProgress)}%`"></span>
                            </span>
                        </div>
                        
                        <div class="flex h-2.5 w-full overflow-hidden rounded-radius bg-surface-alt dark:bg-surface-dark-alt"
                             role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="h-full bg-{{ $progressColor }} dark:bg-{{ $progressColor }}-dark transition-all duration-300 ease-out"
                                 x-bind:style="`width: ${uploadProgress}%`"
                                 x-bind:aria-valuenow="uploadProgress">
                                @if($progressText)
                                    <span class="flex h-full items-center justify-center text-xs font-semibold text-white"
                                          x-show="uploadProgress > 10"
                                          x-text="`${Math.round(uploadProgress)}%`"></span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-1 flex justify-between text-xs text-on-surface/50 dark:text-on-surface-dark/50">
                            <span x-show="uploadSpeed > 0" x-text="`${uploadSpeed} KB/s`"></span>
                            <span x-show="timeRemaining > 0" x-text="`${timeRemaining}s remaining`"></span>
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
