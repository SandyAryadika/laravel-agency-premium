<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-slate-900 border border-white/10 rounded-3xl p-8 shadow-2xl relative overflow-hidden">

        <div class="absolute top-0 right-0 p-12 bg-blue-500/10 blur-3xl rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 p-12 bg-indigo-500/10 blur-3xl rounded-full pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-8">
                <div
                    class="w-14 h-14 bg-slate-800 border border-white/5 rounded-2xl mx-auto flex items-center justify-center shadow-lg mb-4">
                    <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white tracking-tight">Forgot Password?</h2>
                <p class="text-slate-400 text-sm mt-1">No worries, we'll send you reset instructions.</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-emerald-400">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <form wire:submit="sendResetLink" class="space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email
                        Address</label>
                    <input wire:model="email" type="email"
                        class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all placeholder-slate-600"
                        placeholder="Enter your email">
                    @error('email')
                        <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-200 transition-all shadow-lg flex items-center justify-center gap-2">
                    <span wire:loading.remove>Send Reset Link</span>
                    <span wire:loading>Sending...</span>
                </button>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}"
                        class="text-sm text-slate-500 hover:text-white transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Login
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
