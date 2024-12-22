@props([
    'completed' => false,
    'current' => false,
    'number' => null,
])

@if($completed)
    <li class="text-sm">
        <div class="flex items-center gap-2">
			<span
                {{ $attributes->twMerge('flex size-6 items-center justify-center rounded-full bg-black text-neutral-100 dark:bg-white dark:text-black') }}>
				<i class="icon-check"></i>
				<span class="sr-only">completed</span>
			</span>
            <span class="hidden w-max text-black dark:text-white sm:inline">
                {{ $slot }}
            </span>
        </div>
    </li>
@elseif($current)
    <li class="flex w-full items-center text-sm" aria-current="step">
        <span class="h-0.5 w-full bg-black dark:bg-white" aria-hidden="true"></span>
        <div class="flex items-center gap-2 pl-2">
            <span
                {{ $attributes->twMerge('flex size-6 flex-shrink-0 items-center justify-center rounded-full bg-black font-bold text-neutral-100 outline outline-2 outline-offset-2 outline-black dark:bg-white dark:text-black dark:outline-white') }}>
                {{ $number }}
            </span>
            <span class="hidden w-max font-bold text-black dark:text-white sm:inline">
                {{ $slot }}
            </span>
        </div>
    </li>
@else
    <li class="flex w-full items-center text-sm">
        <span class="h-0.5 w-full bg-neutral-300 dark:bg-neutral-700" aria-hidden="true"></span>
        <div class="flex items-center gap-2 pl-2">
        <span
            {{ $attributes->twMerge('flex size-6 flex-shrink-0 items-center justify-center rounded-full bg-neutral-50 font-medium text-neutral-600 dark:bg-neutral-900 dark:text-neutral-300') }}>
            {{ $number }}
        </span>
            <span class="hidden w-max text-neutral-600 dark:text-neutral-300 sm:inline">
                {{ $slot }}
            </span>
        </div>
    </li>
@endif
