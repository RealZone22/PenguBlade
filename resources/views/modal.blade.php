<div>
    <div
        x-data="{
            show: false,
            showActiveComponent: true,
            activeComponent: false,
            componentHistory: [],
            modalWidth: null ,
            listeners: [],
            getActiveComponentModalAttribute(key) {
                if (this.$wire.get('components')[this.activeComponent] !== undefined) {
                    return this.$wire.get('components')[this.activeComponent]['modalAttributes'][key];
                }
            },
            closeModalOnEscape(trigger) {
                if (this.getActiveComponentModalAttribute('closeOnEscape') === false) {
                    return;
                }

                if (!this.closingModal('closingModalOnEscape')) {
                    return;
                }

                let force = this.getActiveComponentModalAttribute('closeOnEscapeIsForceful') === true;
                this.closeModal(force);
            },
            closeModalOnClickAway(trigger) {
                if (this.getActiveComponentModalAttribute('closeOnClickAway') === false) {
                    return;
                }

                if (!this.closingModal('closingModalOnClickAway')) {
                    return;
                }

                this.closeModal(true);
            },
            closingModal(eventName) {
                const componentName = this.$wire.get('components')[this.activeComponent].name;

                var params = {
                    id: this.activeComponent,
                    closing: true,
                };

                Livewire.dispatchTo(componentName, eventName, params);

                return params.closing;
            },
            closeModal(force = false, skipPreviousModals = 0, destroySkipped = false) {
                if(this.show === false) {
                    return;
                }

                if (this.getActiveComponentModalAttribute('dispatchCloseEvent') === true) {
                    const componentName = this.$wire.get('components')[this.activeComponent].name;
                    Livewire.dispatch('modalClosed', {name: componentName});
                }

                if (this.getActiveComponentModalAttribute('destroyOnClose') === true) {
                    Livewire.dispatch('destroyComponent', {id: this.activeComponent});
                }

                if (skipPreviousModals > 0) {
                    for (var i = 0; i < skipPreviousModals; i++) {
                        if (destroySkipped) {
                            const id = this.componentHistory[this.componentHistory.length - 1];
                            Livewire.dispatch('destroyComponent', {id: id});
                        }
                        this.componentHistory.pop();
                    }
                }

                const id = this.componentHistory.pop();

                if (id && !force) {
                    if (id) {
                        this.setActiveModalComponent(id, true);
                    } else {
                        this.setShowPropertyTo(false);
                    }
                } else {
                    this.setShowPropertyTo(false);
                }
            },
            setActiveModalComponent(id, skip = false) {
                this.setShowPropertyTo(true);

                if (this.activeComponent === id) {
                    return;
                }

                if (this.activeComponent !== false && skip === false) {
                    this.componentHistory.push(this.activeComponent);
                }

                let focusableTimeout = 50;

                if (this.activeComponent === false) {
                    this.activeComponent = id
                    this.showActiveComponent = true;
                    this.modalWidth = (this.getActiveComponentModalAttribute('maxWidthClass') || '');
                } else {
                    this.showActiveComponent = false;

                    focusableTimeout = 400;

                    setTimeout(() => {
                        this.activeComponent = id;
                        this.showActiveComponent = true;
                        this.modalWidth = (this.getActiveComponentModalAttribute('maxWidthClass') || '');
                    }, 300);
                }

                this.$nextTick(() => {
                    let focusable = this.$refs[id]?.querySelector('[autofocus]');
                    if (focusable) {
                        setTimeout(() => {
                            focusable.focus();
                        }, focusableTimeout);
                    }
                });
            },
            focusables() {
                let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

                return [...this.$el.querySelectorAll(selector)]
                    .filter(el => !el.hasAttribute('disabled'))
            },
            firstFocusable() {
                return this.focusables()[0]
            },
            lastFocusable() {
                return this.focusables().slice(-1)[0]
            },
            nextFocusable() {
                return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable()
            },
            prevFocusable() {
                return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable()
            },
            nextFocusableIndex() {
                return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1)
            },
            prevFocusableIndex() {
                return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1
            },
            setShowPropertyTo(show) {
                this.show = show;

                if (show) {
                    document.body.classList.add('overflow-y-clip');
                } else {
                    document.body.classList.remove('overflow-y-clip');

                    setTimeout(() => {
                        this.activeComponent = false;
                        this.$wire.resetState();
                    }, 300);
                }
            },
            init() {
                this.listeners.push(
                    Livewire.on('closeModal', (data) => {
                        this.closeModal(data?.force ?? false, data?.skipPreviousModals ?? 0, data?.destroySkipped ?? false);
                    })
                );

                this.listeners.push(
                    Livewire.on('activeModalComponentChanged', ({id}) => {
                        this.setActiveModalComponent(id);
                    })
                );
            },
            destroy() {
                this.listeners.forEach((listener) => {
                    listener();
                });
            }
        }"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="show && closeModalOnEscape();"
        x-show="show"
        x-cloak
        x-trap.noscroll.inert="show && showActiveComponent"
        class="fixed inset-0 z-40 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;"
        role="dialog"
        aria-modal="true"
        wire:transition
    >
        <div
            x-show="show"
            x-on:click="closeModalOnClickAway();"
            class="fixed inset-0 transition-all transform z-30"
        >
        </div>

        <div
            x-show="show && showActiveComponent"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-50"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-75"
            x-bind:class="modalWidth"
            class="flex z-40 flex-col gap-4 overflow-hidden rounded-radius border border-outline bg-surface text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark w-full sm:w-auto sm:min-w-md"
        >
            <div>
                @forelse($components as $id => $component)
                    <div x-show.immediate="activeComponent == '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}">
                        @livewire($component['name'], $component['arguments'], key($id))
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
