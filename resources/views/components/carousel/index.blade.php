@props([
    'slides' => [],
    'indicator' => true,
    'previousButton' => true,
    'nextButton' => true,
    'withText' => false,
    'previousButtonIcon' => 'icon-chevron-left',
    'nextButtonIcon' => 'icon-chevron-right',
])

<div x-data="{
    slides: [
        @foreach($slides as $slide)
            {
                imgSrc: '{{ $slide['imgSrc'] }}',
                imgAlt: '{{ $slide['imgAlt'] }}',
                title: '{{ $slide['title'] ?? '' }}',
                description: '{{ $slide['description'] ?? '' }}',
            },
        @endforeach
    ],
    currentSlideIndex: 1,
    previous() {
        if (this.currentSlideIndex > 1) {
            this.currentSlideIndex = this.currentSlideIndex - 1
        } else {
            this.currentSlideIndex = this.slides.length
        }
    },
    next() {
        if (this.currentSlideIndex < this.slides.length) {
            this.currentSlideIndex = this.currentSlideIndex + 1
        } else {
            this.currentSlideIndex = 1
        }
    },
}" class="relative w-full overflow-hidden">

    @if($previousButton)
        <button type="button"
                class="absolute cursor-pointer left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
                aria-label="previous slide" x-on:click="previous()">
            <i class="{{ $previousButtonIcon }}"></i>
        </button>
    @endif

    @if($nextButton)
        <button type="button"
                class="absolute cursor-pointer right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-surface/40 p-2 text-on-surface transition hover:bg-surface/60 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:outline-offset-0 dark:bg-surface-dark/40 dark:text-on-surface-dark dark:hover:bg-surface-dark/60 dark:focus-visible:outline-primary-dark"
                aria-label="next slide" x-on:click="next()">
            <i class="{{ $nextButtonIcon }}"></i>
        </button>
    @endif

    <div {{ $attributes->twMerge('relative min-h-[50svh] w-full') }}>
        <template x-for="(slide, index) in slides">
            <div x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>

                @if($withText)
                    <div
                        class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-linear-to-t from-surface-dark/85 to-transparent px-16 py-12 text-center">
                        <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-3xl font-bold text-on-surface-dark-strong"
                            x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                        <p class="lg:w-1/2 w-full text-pretty text-sm text-on-surface-dark" x-text="slide.description"
                           x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                    </div>
                @endif

                <img class="absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark"
                     x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt"/>
            </div>
        </template>
    </div>

    @if($indicator)
        <div
            class="absolute rounded-radius bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-surface/75 px-1.5 py-1 md:px-2 dark:bg-surface-dark/75"
            role="group" aria-label="slides">
            <template x-for="(slide, index) in slides">
                <button class="size-2 rounded-full transition bg-on-surface dark:bg-on-surface-dark"
                        x-on:click="currentSlideIndex = index + 1"
                        x-bind:class="[currentSlideIndex === index + 1 ? 'bg-on-surface dark:bg-on-surface-dark' : 'bg-on-surface/50 dark:bg-on-surface-dark/50']"
                        x-bind:aria-label="'slide ' + (index + 1)"></button>
            </template>
        </div>
    @endif
</div>
