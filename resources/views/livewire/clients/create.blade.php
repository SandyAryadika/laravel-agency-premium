<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('clients.index') }}"
            class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Back to Clients
        </a>
        <h1 class="text-3xl font-bold text-white tracking-tight">New Client</h1>
        <p class="text-slate-400 mt-1">Add a new business partner to your network.</p>
    </div>

    <form wire:submit="save" class="bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl p-8 shadow-2xl">
        <div class="space-y-6">

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Client Name / Company</label>
                <input wire:model="name" type="text" placeholder="e.g. Acme Corp"
                    class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-500">
                @error('name')
                    <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email Address</label>
                    <input wire:model="email" type="email" placeholder="contact@company.com"
                        class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-500">
                    @error('email')
                        <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Phone Number</label>
                    <input wire:model="phone" type="text" placeholder="+62..."
                        class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-500">
                    @error('phone')
                        <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-3">Status</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="active" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-emerald-500/10 peer-checked:border-emerald-500/50 peer-checked:text-emerald-400 transition-all">
                            <div class="font-semibold text-sm">Active</div>
                            <div class="text-[10px] opacity-60">Ready for projects</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="status" value="inactive" class="peer sr-only">
                        <div
                            class="text-center p-3 rounded-xl border border-white/10 bg-slate-800/30 text-slate-400 hover:bg-slate-800/60 peer-checked:bg-slate-500/10 peer-checked:border-slate-500/50 peer-checked:text-slate-300 transition-all">
                            <div class="font-semibold text-sm">Inactive</div>
                            <div class="text-[10px] opacity-60">Not currently working</div>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-white/5 flex items-center justify-end gap-4">
            <a href="{{ route('clients.index') }}"
                class="px-5 py-2.5 text-sm font-medium text-slate-400 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Create Client
            </button>
        </div>
    </form>
</div>
