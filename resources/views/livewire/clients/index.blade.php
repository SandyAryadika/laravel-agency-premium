<div class="w-full">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Clients</h1>
            <p class="text-slate-400 mt-1 text-sm">Manage your business relationships.</p>
        </div>

        <a href="{{ route('clients.create') }}"
            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Client
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-4 mb-6">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            </div>
            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text"
                        class="block w-full pl-10 pr-3 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-transparent transition-all"
                        placeholder="Search clients by name or email...">
                </div>

                <div class="w-full md:w-48">
                    <select wire:model.live="status"
                        class="block w-full pl-3 pr-10 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-transparent transition-all appearance-none cursor-pointer">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($clients as $client)
            <div
                class="group relative bg-slate-900/40 border border-white/5 rounded-2xl p-6 hover:bg-slate-800/40 hover:border-white/10 transition-all duration-300 hover:shadow-xl hover:shadow-black/20">

                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 border border-white/5 flex items-center justify-center text-xl font-bold text-white shadow-inner group-hover:scale-105 transition-transform duration-300">
                            {{ substr($client->name, 0, 1) }}
                        </div>
                        <div>
                            <h3
                                class="font-bold text-white text-lg tracking-tight group-hover:text-indigo-400 transition-colors">
                                {{ $client->name }}</h3>
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium uppercase tracking-wider
                                {{ $client->status === 'active' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-500/10 text-slate-400 border border-slate-500/20' }}">
                                {{ $client->status }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('clients.edit', $client->id) }}"
                        class="text-slate-500 hover:text-indigo-400 transition-colors" title="Edit Client">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="space-y-3 mb-6">
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="truncate">{{ $client->email }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <span>{{ $client->phone ?? '-' }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-white/5">
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Active
                            Projects</span>
                        <span class="text-white font-bold text-lg">0</span>
                    </div>
                    <div>
                        <span class="block text-[10px] uppercase tracking-wider text-slate-500 font-semibold">Total
                            Revenue</span>
                        <span class="text-white font-bold text-lg">Rp 0</span>
                    </div>
                </div>

            </div>
        @empty
            <div
                class="col-span-full text-center py-20 bg-slate-900/20 rounded-3xl border border-white/5 border-dashed">
                <div class="w-16 h-16 bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-white font-medium mb-1">No clients found</h3>
                <p class="text-slate-500 text-sm">Add your first client to start tracking projects.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $clients->links() }}
    </div>
</div>
