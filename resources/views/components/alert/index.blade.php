@props([
    'dismissable' => false,
    'dismissIcon' => 'icon-x',
    'color' => 'info',
])
@inject('alertService', 'RealZone22\PenguBlade\Services\PenguBlade\AlertCvaService')

@if($dismissable)
    <div x-data="{ alertIsVisible: true }" x-show="alertIsVisible"
         class="relative w-full overflow-hidden rounded-md bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300"
         role="alert" x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

        <div {{ $attributes->twMerge($alertService::new()(['color' => $color])) }}>

            {{ $slot }}

            <button type="button" @click="alertIsVisible = false" class="ml-auto" aria-label="dismiss alert">
                <i class="{{ $dismissIcon }}"></i>
            </button>
        </div>
    </div>
@else
    <div
        class="relative w-full overflow-hidden rounded-md bg-white text-neutral-600 dark:bg-neutral-950 dark:text-neutral-300"
        role="alert" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

        <div {{ $attributes->twMerge($alertService::new()(['color' => $color])) }}>

            {{ $slot }}

        </div>
    </div>
@endif

