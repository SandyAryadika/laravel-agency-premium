<div class="min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-slate-900 border border-white/10 rounded-3xl p-8 shadow-2xl relative overflow-hidden">

        <div class="absolute top-0 right-0 p-12 bg-blue-500/10 blur-3xl rounded-full pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 p-12 bg-indigo-500/10 blur-3xl rounded-full pointer-events-none"></div>

        <div class="relative z-10">
            <div class="text-center mb-10">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl mx-auto flex items-center justify-center shadow-lg shadow-blue-600/20 mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Welcome Back</h2>
                <p class="text-slate-400 text-sm mt-1">Sign in to access your workspace</p>
            </div>

            <form wire:submit="login" class="space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Email
                        Address</label>
                    <input wire:model="email" type="email"
                        class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all placeholder-slate-600"
                        placeholder="architect@devscript.lab">
                    @error('email')
                        <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label
                        class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Password</label>
                    <input wire:model="password" type="password"
                        class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all placeholder-slate-600"
                        placeholder="••••••••">
                    @error('password')
                        <span class="text-xs text-red-400 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="remember" type="checkbox"
                            class="rounded bg-slate-800 border-white/10 text-blue-600 focus:ring-offset-slate-900">
                        <span class="text-sm text-slate-400">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-400 hover:text-blue-300 transition-colors">Forgot Password?</a>
                </div>

                <button type="submit"
                    class="w-full py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded-xl shadow-lg shadow-blue-600/20 transition-all flex items-center justify-center gap-2">
                    <span wire:loading.remove>Sign In</span>
                    <span wire:loading>Authenticating...</span>
                </button>

            </form>
        </div>
    </div>
</div>
