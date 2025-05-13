@props([
    'current' => false,
    'completed' => false,
    'number' => null,
    'start' => false,
    'completeIcon' => 'icon-check',
    'label' => null,
    'tooltip' => null,
])

@if($completed)
    <li class="text-sm">
        <div class="flex items-center gap-2" @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
			<span
                {{ $attributes->twMerge('flex size-6 items-center justify-center rounded-full border-primary bg-primary text-on-primary dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark') }}>
				<i class="{{ $completeIcon }}"></i>
			</span>
            @if($label)
                <span class="hidden w-max text-primary dark:text-primary-dark sm:inline">{{ $label }}</span>
            @endif
        </div>
    </li>
@elseif($current)
    <li class="flex w-full items-center text-sm">
        <span class="h-0.5 w-full bg-primary dark:bg-primary-dark"></span>
        <div class="flex items-center gap-2 pl-2" @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
            <span
                {{ $attributes->twMerge('flex size-6 shrink-0 items-center justify-center rounded-full border-primary bg-primary font-bold text-on-primary outline outline-2 outline-offset-2 outline-primary dark:border-primary-dark dark:bg-primary-dark dark:text-on-primary-dark dark:outline-primary-dark') }}>{{ $number }}</span>
            @if($label)
                <span class="hidden w-max text-primary dark:text-primary-dark sm:inline">{{ $label }}</span>
            @endif
        </div>
    </li>
@else
    <li class="flex w-full items-center text-sm">
        <span class="h-0.5 w-full bg-outline dark:bg-outline-dark"></span>
        <div class="flex items-center gap-2 pl-2" @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif>
            <span
                {{ $attributes->twMerge('flex size-6 shrink-0 items-center justify-center rounded-full border-outline bg-surface-alt font-medium text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark') }}>{{ $number }}</span>
            @if($label)
                <span class="hidden w-max text-primary dark:text-primary-dark sm:inline">{{ $label }}</span>
            @endif
        </div>
    </li>
@endif
