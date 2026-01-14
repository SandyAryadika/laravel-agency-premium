<div class="max-w-4xl mx-auto">
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-white tracking-tight">Settings</h1>
        <p class="text-slate-400 mt-1 text-sm">Manage your profile and agency preferences.</p>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3 animate-fade-in-down">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <section>
            <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Personal Profile
            </h2>

            <form wire:submit="save"
                class="bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                <div class="space-y-5">

                    <div class="flex items-center gap-4">
                        <div
                            class="w-16 h-16 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xl font-bold text-white shadow-lg">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-white">Profile Photo</div>
                            <div class="text-xs text-slate-500">Auto-generated from name</div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Full
                            Name</label>
                        <input wire:model="name" type="text"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all">
                        @error('name')
                            <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Tagline
                            / Job Title</label>
                        <input wire:model="tagline" type="text" placeholder="e.g. Senior Architect"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all placeholder-slate-600">
                        <p class="text-[10px] text-slate-500 mt-1">Displayed below your name in the sidebar.</p>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email
                            Address</label>
                        <input wire:model="email" type="email" disabled
                            class="w-full bg-slate-800/30 border border-white/5 rounded-xl px-4 py-2.5 text-slate-400 cursor-not-allowed">
                        <p class="text-[10px] text-slate-500 mt-1">Contact support to change email.</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-600/20">
                        Update Profile
                    </button>
                </div>
            </form>
        </section>


        <section>
            <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                Agency Branding
            </h2>

            <form wire:submit="save"
                class="bg-slate-900/50 backdrop-blur-xl border border-white/5 rounded-3xl p-6 shadow-xl h-fit">

                <div class="space-y-5">

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Agency
                            Logo</label>
                        <div class="flex items-center gap-4">
                            <div
                                class="relative w-16 h-16 rounded-xl bg-slate-800 border border-white/10 overflow-hidden flex items-center justify-center group">
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                @elseif ($existingLogo)
                                    <img src="{{ asset('storage/' . $existingLogo) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif

                                <div wire:loading wire:target="photo"
                                    class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <svg class="animate-spin w-5 h-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <input type="file" wire:model="photo" id="agency-logo"
                                    class="peer absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <label for="agency-logo"
                                    class="px-4 py-2 bg-slate-800 hover:bg-slate-700 border border-white/10 rounded-lg text-xs font-medium text-white transition-all cursor-pointer">
                                    Change Logo
                                </label>
                                <p class="text-[10px] text-slate-500 mt-1.5">PNG/JPG, Max 1MB.</p>
                            </div>
                        </div>
                        @error('photo')
                            <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Agency
                            Name</label>
                        <input wire:model="agency_name" type="text" placeholder="e.g. Acme Studio"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-600">
                        @error('agency_name')
                            <span class="text-xs text-red-400 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Business
                            Email</label>
                        <input wire:model="agency_email" type="email" placeholder="contact@acme.com"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-600">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Office
                            Address</label>
                        <textarea wire:model="agency_address" rows="3" placeholder="Full address for invoice header..."
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all placeholder-slate-600 resize-none"></textarea>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/5 flex justify-end">
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                        <svg wire:loading wire:target="save" class="animate-spin h-4 w-4" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Save Agency Info
                    </button>
                </div>
            </form>
        </section>

    </div>
</div>
