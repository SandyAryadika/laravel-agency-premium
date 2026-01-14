<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('projects.show', $project->id) }}"
            class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Project Details
        </a>
        <h1 class="text-3xl font-bold text-white tracking-tight">Edit Project</h1>
        <p class="text-slate-400 mt-1">Update workspace information.</p>
    </div>

    <form wire:submit="update"
        class="bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl p-8 shadow-2xl">
        <div class="space-y-6">

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Project Name</label>
                <input wire:model="name" type="text"
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                @error('name')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Description</label>
                <textarea wire:model="description" rows="3"
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Budget (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-slate-500">Rp</span>
                        <input wire:model="budget" type="number"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl pl-10 pr-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Deadline</label>
                    <input wire:model="due_date" type="date"
                        class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all [color-scheme:dark]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">Project Status</label>
                <div class="grid grid-cols-3 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="active" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-emerald-500/10 peer-checked:border-emerald-500/50 peer-checked:text-emerald-400 transition-all">
                            Active
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="completed" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-blue-500/10 peer-checked:border-blue-500/50 peer-checked:text-blue-400 transition-all">
                            Completed
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="archived" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-slate-500/10 peer-checked:border-slate-500/50 peer-checked:text-slate-300 transition-all">
                            Archived
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-end gap-4">
            <a href="{{ route('projects.show', $project->id) }}"
                class="px-5 py-2.5 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 transition-all flex items-center gap-2">
                <svg wire:loading wire:target="update" class="animate-spin h-4 w-4 text-white" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Save Changes
            </button>
        </div>
    </form>
</div>
