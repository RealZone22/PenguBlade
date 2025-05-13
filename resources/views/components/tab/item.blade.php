@props([
    'uuid' => 'pengublade-tab-' . str()->uuid(),
    'href' => null,
    'tooltip' => null,
])

@if($href)
    <a @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
       :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
       :class="selectedTab === '{{ $uuid }}' ? 'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' : 'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
       :selected="selectedTab === '{{ $uuid }}'"
       @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
       href="{{ $href }}"
       {{ $attributes->twMerge('h-min px-4 py-2 text-sm cursor-pointer') }} role="tab"
       aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </a>
@else
    <button @click="selectedTab = '{{ $uuid }}'" :aria-selected="selectedTab === '{{ $uuid }}'"
            :tabindex="selectedTab === '{{ $uuid }}' ? '0' : '-1'"
            :class="selectedTab === '{{ $uuid }}' ? 'font-bold text-primary border-b-2 border-primary dark:border-primary-dark dark:text-primary-dark' : 'text-on-surface font-medium dark:text-on-surface-dark dark:hover:border-b-outline-dark-strong dark:hover:text-on-surface-dark-strong hover:border-b-2 hover:border-b-outline-strong hover:text-on-surface-strong'"
            :selected="selectedTab === '{{ $uuid }}'"
            @if($tooltip) x-data x-tooltip.raw="{{ $tooltip }}" @endif
            {{ $attributes->twMerge('h-min px-4 py-2 text-sm cursor-pointer') }} type="button" role="tab"
            aria-controls="tabpanel{{ ucfirst($uuid) }}">
        {{ $slot }}
    </button>
@endif
