<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('projects.index') }}"
            class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Projects
        </a>
        <h1 class="text-3xl font-bold text-white tracking-tight">New Project</h1>
        <p class="text-slate-400 mt-1">Initialize a new workspace linked to a client.</p>
    </div>

    <form wire:submit="save" class="bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl p-8 shadow-2xl">
        <div class="space-y-6">

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Assign Client</label>
                <div class="relative">
                    <select wire:model="client_id"
                        class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 appearance-none cursor-pointer">
                        <option value="">-- Choose Client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
                @error('client_id')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Project Name</label>
                <input wire:model="name" type="text" placeholder="e.g. Website Redesign"
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                @error('name')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Description</label>
                <textarea wire:model="description" rows="3" placeholder="Brief details about the project scope..."
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Deadline (End Date)</label>
                <input wire:model="end_date" type="date"
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all [color-scheme:dark]">
                @error('end_date')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">Initial Status</label>
                <div class="grid grid-cols-3 gap-4">

                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="pending" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-slate-500/10 peer-checked:border-slate-500/50 peer-checked:text-slate-300 transition-all">
                            Active (Pending)
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="active" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-blue-500/10 peer-checked:border-blue-500/50 peer-checked:text-blue-400 transition-all">
                            In Progress
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="completed" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-emerald-500/10 peer-checked:border-emerald-500/50 peer-checked:text-emerald-400 transition-all">
                            Completed
                        </div>
                    </label>

                </div>
                @error('status')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-end gap-4">
            <a href="{{ route('projects.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 transition-all flex items-center gap-2">
                <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Create Project
            </button>
        </div>
    </form>
</div>
