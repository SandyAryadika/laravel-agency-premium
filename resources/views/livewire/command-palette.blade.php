<div x-data="{
    open: false,
    selectedIndex: 0,
    toggle() {
        this.open = !this.open;
        if (this.open) {
            this.$nextTick(() => $refs.searchInput.focus());
            this.selectedIndex = 0;
        }
    },
    selectNext() {
        if (this.selectedIndex < {{ count($results) }} - 1) {
            this.selectedIndex++;
            this.$refs.resultsList.children[this.selectedIndex]?.scrollIntoView({ block: 'nearest' });
        }
    },
    selectPrev() {
        if (this.selectedIndex > 0) {
            this.selectedIndex--;
            this.$refs.resultsList.children[this.selectedIndex]?.scrollIntoView({ block: 'nearest' });
        }
    },
    selectResult() {
        // Ambil link dari element yang aktif dan klik
        const activeEl = this.$refs.resultsList.children[this.selectedIndex];
        if (activeEl) {
            window.location.href = activeEl.dataset.url;
        }
    }
}" @keydown.window.prevent.cmd.k="toggle()" @keydown.window.prevent.ctrl.k="toggle()"
    @keydown.window.escape="open = false" class="relative z-50">

    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-50"
        @click="open = false">
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-start justify-center pt-24 pointer-events-none">

        <div
            class="bg-slate-900 border border-white/10 w-full max-w-2xl rounded-2xl shadow-2xl pointer-events-auto overflow-hidden flex flex-col max-h-[60vh]">

            <div class="flex items-center border-b border-white/5 p-4 gap-3">
                <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input x-ref="searchInput" wire:model.live.debounce.100ms="search"
                    @keydown.arrow-down.prevent="selectNext()" @keydown.arrow-up.prevent="selectPrev()"
                    @keydown.enter.prevent="selectResult()" type="text" placeholder="Type a command or search..."
                    class="flex-1 bg-transparent text-lg text-white placeholder-slate-500 focus:outline-none"
                    autocomplete="off">
                <div class="px-2 py-1 bg-white/10 rounded text-xs text-slate-400 font-mono">ESC</div>
            </div>

            <div x-ref="resultsList" class="overflow-y-auto p-2 custom-scrollbar">
                @forelse($results as $index => $result)
                    <div :class="{ 'bg-blue-600': selectedIndex === {{ $index }}, 'bg-transparent': selectedIndex !==
                            {{ $index }} }"
                        @click="window.location.href = '{{ $result['route'] }}'"
                        @mousemove="selectedIndex = {{ $index }}" data-url="{{ $result['route'] }}"
                        class="group flex items-center justify-between p-3 rounded-xl cursor-pointer transition-colors">

                        <div class="flex items-center gap-3">
                            <div
                                :class="{ 'text-white': selectedIndex ===
                                    {{ $index }}, 'text-slate-500': selectedIndex !== {{ $index }} }">
                                @if ($result['icon'] === 'Home')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'Document')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'Folder')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'FolderOpen')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'Users')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'User')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                @elseif($result['icon'] === 'Plus')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                @elseif($result['icon'] === 'Cog')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                @endif
                            </div>

                            <span class="text-white font-medium">{{ $result['title'] }}</span>
                        </div>

                        <span
                            :class="{ 'text-blue-200': selectedIndex ===
                                {{ $index }}, 'text-slate-600': selectedIndex !== {{ $index }} }"
                            class="text-xs uppercase tracking-wider font-semibold">
                            {{ $result['group'] }}
                        </span>
                    </div>
                @empty
                    <div class="p-8 text-center" x-show="!$wire.search">
                        <p class="text-slate-500 text-sm">Type 'Create' or project name...</p>
                    </div>
                    <div class="p-8 text-center" x-show="$wire.search && $wire.results.length === 0">
                        <p class="text-slate-500 text-sm">No results found.</p>
                    </div>
                @endforelse
            </div>

            <div
                class="p-3 bg-slate-800/50 border-t border-white/5 flex items-center justify-between text-[10px] text-slate-500">
                <div class="flex gap-4">
                    <span><strong class="text-slate-400">↑↓</strong> to navigate</span>
                    <span><strong class="text-slate-400">↵</strong> to select</span>
                </div>
                <span><strong class="text-slate-400">ESC</strong> to close</span>
            </div>

        </div>
    </div>
</div>
