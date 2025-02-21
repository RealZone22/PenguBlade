@props([
    // dont replace with alpine
    'uuid' => 'pengublade-tab-' . str()->uuid(),
    'href' => null,
])

@if($href)
    <a @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
       :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
       :class="selectedTab === '{{ $uuid }}' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
       :selected="selectedTab === '{{ $uuid }}'"
       href="{{ $href }}"
       {{ $attributes->twMerge('h-min px-4 py-2 text-sm text-center cursor-pointer') }} role="tab"
       aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </a>
@else
    <button @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
            :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
            :class="selectedTab === '{{ $uuid }}' ? 'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' : 'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
            :selected="selectedTab === '{{ $uuid }}'"
            {{ $attributes->twMerge('h-min px-4 py-2 text-sm cursor-pointer') }} type="button" role="tab"
            aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </button>
@endif
