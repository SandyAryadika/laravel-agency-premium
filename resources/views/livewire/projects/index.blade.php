<div class="h-full flex flex-col">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Projects Board</h1>
            <p class="text-slate-400 mt-1 text-sm">Manage your ongoing and completed works. Drag and drop projects to
                update their status.</p>
        </div>

        <button
            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Project
        </button>
    </div>

    <div class="mb-8">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input wire:model.live.debounce.300ms="search" type="text"
                class="block w-full pl-10 pr-3 py-3 bg-slate-900/50 border border-white/10 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all"
                placeholder="Search projects...">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-full overflow-hidden" wire:sortable-group="updateStatus">

        <div class="flex flex-col h-full bg-slate-900/30 border border-white/5 rounded-2xl overflow-hidden">
            <div class="p-4 bg-white/5 border-b border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-slate-500"></div>
                    <h3 class="font-bold text-slate-300 text-sm tracking-wide uppercase">Pending</h3>
                </div>
                <span
                    class="bg-slate-800 text-slate-400 text-xs font-bold px-2 py-1 rounded-lg border border-white/5">{{ $pendingProjects->count() }}</span>
            </div>

            <div class="flex-1 p-3 space-y-3 overflow-y-auto custom-scrollbar" wire:sortable-group.item-group="pending">
                @forelse($pendingProjects as $project)
                    <div wire:sortable-group.item="{{ $project->id }}" wire:key="project-{{ $project->id }}"
                        class="bg-slate-800 border border-white/5 p-4 rounded-xl cursor-grab active:cursor-grabbing hover:border-slate-500/50 transition-all shadow-sm group relative">

                        <div class="flex justify-between items-start mb-2">
                            <span
                                class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-700 text-slate-300 border border-white/5">
                                {{ $project->client->name ?? 'No Client' }}
                            </span>
                        </div>

                        <h4 class="text-white font-semibold mb-1 group-hover:text-blue-400 transition-colors">
                            {{ $project->name }}</h4>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-4">{{ $project->description }}</p>

                        <div class="flex items-center justify-between pt-3 border-t border-white/5">
                            <div class="text-xs font-mono text-slate-400">
                                {{ $project->due_date ? $project->due_date->format('d M') : 'No Due Date' }}
                            </div>
                            <div class="text-xs font-bold text-slate-300">
                                Rp {{ number_format($project->budget / 1000000, 0) }}jt
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 border-2 border-dashed border-white/5 rounded-xl">
                        <p class="text-slate-600 text-xs">No pending projects</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col h-full bg-slate-900/30 border border-white/5 rounded-2xl overflow-hidden">
            <div class="p-4 bg-blue-500/10 border-b border-blue-500/10 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-blue-500 animate-pulse"></div>
                    <h3 class="font-bold text-blue-400 text-sm tracking-wide uppercase">In Progress</h3>
                </div>
                <span
                    class="bg-blue-500/20 text-blue-300 text-xs font-bold px-2 py-1 rounded-lg border border-blue-500/20">{{ $inProgressProjects->count() }}</span>
            </div>

            <div class="flex-1 p-3 space-y-3 overflow-y-auto custom-scrollbar"
                wire:sortable-group.item-group="in_progress">
                @forelse($inProgressProjects as $project)
                    <div wire:sortable-group.item="{{ $project->id }}" wire:key="project-{{ $project->id }}"
                        class="bg-slate-800 border border-white/5 p-4 rounded-xl cursor-grab active:cursor-grabbing hover:border-blue-500/50 transition-all shadow-sm group relative">

                        <div class="flex justify-between items-start mb-2">
                            <span
                                class="text-[10px] font-bold px-2 py-0.5 rounded bg-blue-900/30 text-blue-300 border border-blue-500/20">
                                {{ $project->client->name ?? 'No Client' }}
                            </span>
                        </div>

                        <h4 class="text-white font-semibold mb-1 group-hover:text-blue-400 transition-colors">
                            {{ $project->name }}</h4>
                        <p class="text-xs text-slate-500 line-clamp-2 mb-4">{{ $project->description }}</p>

                        <div class="flex items-center justify-between pt-3 border-t border-white/5">
                            <div class="text-xs font-mono text-slate-400">
                                {{ $project->due_date ? $project->due_date->format('d M') : 'No Due Date' }}
                            </div>
                            <div class="text-xs font-bold text-white">
                                Rp {{ number_format($project->budget / 1000000, 0) }}jt
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 border-2 border-dashed border-white/5 rounded-xl">
                        <p class="text-slate-600 text-xs">No active projects</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col h-full bg-slate-900/30 border border-white/5 rounded-2xl overflow-hidden">
            <div class="p-4 bg-emerald-500/10 border-b border-emerald-500/10 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                    <h3 class="font-bold text-emerald-400 text-sm tracking-wide uppercase">Completed</h3>
                </div>
                <span
                    class="bg-emerald-500/20 text-emerald-300 text-xs font-bold px-2 py-1 rounded-lg border border-emerald-500/20">{{ $completedProjects->count() }}</span>
            </div>

            <div class="flex-1 p-3 space-y-3 overflow-y-auto custom-scrollbar"
                wire:sortable-group.item-group="completed">
                @forelse($completedProjects as $project)
                    <div wire:sortable-group.item="{{ $project->id }}" wire:key="project-{{ $project->id }}"
                        class="bg-slate-800 border border-white/5 p-4 rounded-xl cursor-grab active:cursor-grabbing hover:border-emerald-500/50 transition-all shadow-sm group relative opacity-75 hover:opacity-100">

                        <div class="flex justify-between items-start mb-2">
                            <span
                                class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-900/30 text-emerald-300 border border-emerald-500/20">
                                {{ $project->client->name ?? 'No Client' }}
                            </span>
                            <div class="w-4 h-4 rounded-full bg-emerald-500 flex items-center justify-center">
                                <svg class="w-2.5 h-2.5 text-black font-bold" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <h4 class="text-slate-300 font-semibold mb-1 line-through decoration-slate-500">
                            {{ $project->name }}</h4>

                        <div class="flex items-center justify-between pt-3 border-t border-white/5 mt-4">
                            <span class="text-[10px] text-emerald-400 font-mono">Finished</span>
                            <div class="text-xs font-bold text-slate-400">
                                Rp {{ number_format($project->budget / 1000000, 0) }}jt
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 border-2 border-dashed border-white/5 rounded-xl">
                        <p class="text-slate-600 text-xs">No completed projects</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
