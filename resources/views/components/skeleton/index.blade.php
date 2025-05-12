@props([
    'type' => 'text',
    'tableRows' => 3,
    'tableColumns' => 4,
])

@switch($type)
    @case('text')
        <div class="flex w-full flex-col gap-2">
            <div
                {{ $attributes->twMerge('h-3.5 w-full animate-pulse rounded-radius bg-on-surface/30 dark:bg-on-surface-dark/30') }}
                aria-hidden="true"></div>
            {{ $slot }}
            <span class="sr-only">loading</span>
        </div>
        @break

    @case('image')
        <div>
            <div
                {{ $attributes->twMerge('flex h-44 w-60 items-center justify-center rounded-radius bg-on-surface/30 motion-safe:animate-pulse dark:bg-on-surface-dark/30') }}
                aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                     class="size-12 fill-on-surface/30 dark:fill-on-surface-dark/30">
                    <path fill-rule="evenodd"
                          d="M1 5.25A2.25 2.25 0 0 1 3.25 3h13.5A2.25 2.25 0 0 1 19 5.25v9.5A2.25 2.25 0 0 1 16.75 17H3.25A2.25 2.25 0 0 1 1 14.75v-9.5Zm1.5 5.81v3.69c0 .414.336.75.75.75h13.5a.75.75 0 0 0 .75-.75v-2.69l-2.22-2.219a.75.75 0 0 0-1.06 0l-1.91 1.909.47.47a.75.75 0 1 1-1.06 1.06L6.53 8.091a.75.75 0 0 0-1.06 0l-2.97 2.97ZM12 7a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
            {{ $slot }}
            <span class="sr-only">loading</span>
        </div>
        @break

    @case('table')
        <div class="overflow-hidden rounded-radius">
            @for ($i = 0; $i < $tableRows; $i++)
                <div
                    class="flex w-full animate-pulse items-center gap-2 rounded-radius p-2 {{ $i > 0 ? 'mt-2' : '' }} bg-on-surface/30 dark:bg-on-surface-dark/30">
                    @for ($j = 0; $j < $tableColumns; $j++)
                        <div
                            class="h-3.5 w-full animate-pulse rounded-radius bg-on-surface/30 dark:bg-on-surface-dark/30"
                            aria-hidden="true"></div>
                    @endfor
                </div>
            @endfor
            {{ $slot }}
            <span class="sr-only">loading</span>
        </div>
        @break

    @case('avatar')
        <div class="flex items-center gap-2">
            <div class="size-16 animate-pulse rounded-full bg-on-surface/30 dark:bg-on-surface-dark/30"
                 aria-hidden="true"></div>
            <div class="flex w-52 flex-col gap-2">
                <div class="h-3.5 w-full animate-pulse rounded-radius bg-on-surface/30 dark:bg-on-surface-dark/30"
                     aria-hidden="true"></div>
                <div class="h-3.5 w-1/2 animate-pulse rounded-radius bg-on-surface/30 dark:bg-on-surface-dark/30"
                     aria-hidden="true"></div>
            </div>
            {{ $slot }}
            <span class="sr-only">loading</span>
        </div>
        @break

    @default
        <div
            {{ $attributes->twMerge('h-3.5 w-full animate-pulse rounded-md bg-on-surface/30 dark:bg-on-surface-dark/30') }} aria-hidden="true"></div>

@endswitch
