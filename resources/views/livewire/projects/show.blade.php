<div class="max-w-6xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('projects.index') }}"
            class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Projects
        </a>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight flex items-center gap-3">
                    {{ $project->name }}
                    <span
                        class="text-sm px-3 py-1 rounded-full border 
                        {{ $project->status === 'active' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : '' }}
                        {{ $project->status === 'completed' ? 'bg-blue-500/10 border-blue-500/20 text-blue-400' : '' }}
                        {{ $project->status === 'archived' ? 'bg-slate-500/10 border-slate-500/20 text-slate-400' : '' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </h1>
                <p class="text-slate-400 mt-2 max-w-2xl">{{ $project->description }}</p>
            </div>

            <a href="{{ route('projects.edit', $project->id) }}"
                class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white text-sm font-medium rounded-xl border border-white/10 transition-all">
                Edit Details
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">

            <form wire:submit="addTask" class="relative group z-20">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500 group-focus-within:text-blue-500 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>

                <input wire:model="newTaskTitle" type="text" placeholder="What needs to be done next?"
                    class="w-full bg-slate-900/50 backdrop-blur-xl border border-white/10 rounded-2xl pl-12 pr-36 py-4 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all shadow-lg">

                <button type="submit"
                    class="absolute right-2 top-2 bottom-2 px-4 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2">

                    <svg wire:loading wire:target="addTask" class="animate-spin h-4 w-4 text-white" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>

                    <span wire:loading.remove wire:target="addTask">Add Task</span>
                    <span wire:loading wire:target="addTask">Saving...</span>
                </button>
            </form>
            <div class="space-y-3">
                @forelse($tasks as $task)
                    <div
                        class="group flex items-center justify-between p-4 bg-slate-900/40 border border-white/5 rounded-2xl hover:bg-slate-800/60 transition-all duration-300 {{ $task->is_completed ? 'opacity-60' : '' }}">
                        <div class="flex items-center gap-4 flex-1">
                            <button wire:click="toggleTask('{{ $task->id }}')"
                                class="w-6 h-6 rounded-lg border-2 flex items-center justify-center transition-all duration-300
                                {{ $task->is_completed ? 'bg-emerald-500 border-emerald-500' : 'border-slate-600 hover:border-emerald-500' }}">
                                @if ($task->is_completed)
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @endif
                            </button>

                            <span
                                class="text-sm font-medium {{ $task->is_completed ? 'text-slate-500 line-through' : 'text-slate-200' }}">
                                {{ $task->title }}
                            </span>
                        </div>

                        <button wire:click="deleteTask('{{ $task->id }}')"
                            class="opacity-0 group-hover:opacity-100 text-slate-500 hover:text-red-400 transition-all p-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </div>
                @empty
                    <div class="text-center py-12 border border-dashed border-white/10 rounded-2xl">
                        <p class="text-slate-500 text-sm">No tasks yet. Start by adding one above.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-6">
            <div class="p-6 bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl">
                <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6">Project Details</h3>

                <div class="space-y-5">
                    <div>
                        <span class="text-xs text-slate-500 block mb-1">Budget</span>
                        <span class="text-xl font-bold text-white">Rp
                            {{ number_format($project->budget, 0, ',', '.') }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Start Date</span>
                            <span class="text-sm text-slate-300">{{ $project->start_date->format('d M Y') }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Deadline</span>
                            <span
                                class="text-sm text-slate-300">{{ $project->due_date ? $project->due_date->format('d M Y') : '-' }}</span>
                        </div>
                    </div>

                    <div class="pt-5 border-t border-white/5">
                        <span class="text-xs text-slate-500 block mb-2">Progress</span>
                        @php
                            $total = $project->tasks()->count();
                            $done = $project->tasks()->where('is_completed', true)->count();
                            $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                        @endphp
                        <div class="w-full bg-slate-800 rounded-full h-2 mb-2">
                            <div class="bg-blue-500 h-2 rounded-full transition-all duration-500"
                                style="width: {{ $percent }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-slate-400">
                            <span>{{ $done }} / {{ $total }} Tasks</span>
                            <span>{{ $percent }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 rounded-3xl border border-red-500/10 bg-red-500/5 hover:bg-red-500/10 transition-colors">
                <h4 class="text-red-400 font-medium mb-2">Delete Project</h4>
                <p class="text-xs text-red-400/70 mb-4">Once deleted, all data and tasks will be permanently removed.
                </p>
                <button wire:click="deleteProject" wire:confirm="Are you sure you want to delete this project?"
                    class="w-full py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 text-sm font-medium rounded-xl border border-red-500/20 transition-all">
                    Delete Project
                </button>
            </div>
        </div>
    </div>
</div>
