<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'AgencyFlow' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
        }

        /* Slate-900 */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-950 text-slate-200 antialiased selection:bg-blue-500 selection:text-white">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-72 bg-slate-900 border-r border-white/5 flex flex-col shrink-0">

            <div class="h-20 flex items-center px-8 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white tracking-tight">AgencyFlow
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest font-semibold">Premium Setup
                            </p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
                   {{ request()->routeIs('dashboard') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Workspace</p>
                </div>

                <a href="{{ route('projects.index') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
                   {{ request()->routeIs('projects.*') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('projects.*') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    Projects
                </a>

                <a href="{{ route('clients.index') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
                   {{ request()->routeIs('clients.*') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('clients.*') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Clients
                </a>

                <a href="{{ route('invoices.index') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
                   {{ request()->routeIs('invoices.*') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('invoices.*') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Invoices
                </a>

                <a href="{{ route('expenses.index') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
   {{ request()->routeIs('expenses.*') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('expenses.*') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Expenses
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest">System</p>
                </div>

                <a href="{{ route('settings') }}"
                    class="flex items-center gap-3 px-4 py-3.5 text-sm font-medium rounded-2xl transition-all
                   {{ request()->routeIs('settings') ? 'text-white bg-white/5 border border-white/5 shadow-inner shadow-white/5' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('settings') ? 'text-blue-400' : '' }}" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>

            <div class="p-4 border-t border-white/5">
                @auth
                    <div
                        class="flex items-center justify-between gap-2 p-3 rounded-2xl bg-white/5 border border-white/5 group">

                        <div class="flex items-center gap-3 overflow-hidden">
                            <div
                                class="w-9 h-9 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <div class="text-sm font-medium text-white truncate w-24">{{ auth()->user()->name }}</div>
                                <div class="text-[10px] text-slate-400 truncate w-24">
                                    {{ auth()->user()->tagline ?? 'Online' }}
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="p-2 text-slate-500 hover:text-rose-400 hover:bg-rose-500/10 rounded-lg transition-colors"
                                title="Sign Out">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </button>
                        </form>

                    </div>
                @endauth
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto overflow-x-hidden bg-slate-950 p-8 custom-scrollbar">
            {{ $slot }}
        </main>
    </div>


    <div class="fixed bottom-8 right-8 z-40" x-data>
        <button @click="$dispatch('open-help')"
            class="w-12 h-12 rounded-full bg-blue-600 hover:bg-blue-500 text-white shadow-lg shadow-blue-600/30 flex items-center justify-center transition-all hover:scale-110 group"
            title="Keyboard Shortcuts & Help">
            <span class="font-bold text-xl group-hover:hidden">?</span>
            <svg class="w-6 h-6 hidden group-hover:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                </path>
            </svg>
        </button>
    </div>


    <div x-data="{ open: false }" @open-help.window="open = true" @keydown.escape.window="open = false"
        x-show="open" style="display: none;" class="relative z-[60]">

        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"
            @click="open = false"></div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="fixed inset-0 flex items-center justify-center p-4 pointer-events-none">

            <div
                class="bg-slate-900 border border-white/10 w-full max-w-3xl rounded-3xl shadow-2xl pointer-events-auto p-8 overflow-hidden relative">

                <button @click="open = false"
                    class="absolute top-6 right-6 text-slate-500 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-white flex items-center gap-3">
                        <span class="p-2 rounded-lg bg-blue-500/10 text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </span>
                        Power User Shortcuts
                    </h3>
                    <p class="text-slate-400 mt-2 ml-12">Master your workflow with these quick actions.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="space-y-4">
                        <h4
                            class="text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-white/5 pb-2 mb-4">
                            Navigation</h4>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Command
                                Palette</span>
                            <div class="flex gap-1">
                                <kbd
                                    class="min-w-[32px] text-center px-2 py-1.5 bg-slate-800 rounded-lg text-xs text-slate-200 font-mono border-b-2 border-slate-700 shadow-sm">CMD</kbd>
                                <span class="text-slate-600 self-center">+</span>
                                <kbd
                                    class="min-w-[24px] text-center px-2 py-1.5 bg-slate-800 rounded-lg text-xs text-slate-200 font-mono border-b-2 border-slate-700 shadow-sm">K</kbd>
                            </div>
                        </div>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Select Next
                                Item</span>
                            <kbd
                                class="min-w-[24px] text-center px-2 py-1.5 bg-slate-800 rounded-lg text-xs text-slate-200 font-mono border-b-2 border-slate-700 shadow-sm">↓</kbd>
                        </div>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Select
                                Previous</span>
                            <kbd
                                class="min-w-[24px] text-center px-2 py-1.5 bg-slate-800 rounded-lg text-xs text-slate-200 font-mono border-b-2 border-slate-700 shadow-sm">↑</kbd>
                        </div>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Close Any
                                Modal</span>
                            <kbd
                                class="min-w-[32px] text-center px-2 py-1.5 bg-slate-800 rounded-lg text-xs text-slate-200 font-mono border-b-2 border-slate-700 shadow-sm">ESC</kbd>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4
                            class="text-xs font-bold text-slate-500 uppercase tracking-widest border-b border-white/5 pb-2 mb-4">
                            Pro Actions</h4>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Move Project
                                Card</span>
                            <span
                                class="px-2 py-1 bg-blue-500/10 text-blue-400 text-xs font-medium rounded border border-blue-500/20">Drag
                                & Drop</span>
                        </div>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Send Email
                                Invoice</span>
                            <span
                                class="px-2 py-1 bg-emerald-500/10 text-emerald-400 text-xs font-medium rounded border border-emerald-500/20">One-Click</span>
                        </div>

                        <div class="flex items-center justify-between group">
                            <span class="text-slate-300 group-hover:text-white transition-colors">Download PDF</span>
                            <span
                                class="px-2 py-1 bg-slate-700/50 text-slate-300 text-xs font-medium rounded border border-slate-600/30">Auto
                                Gen</span>
                        </div>

                        <div class="mt-6 pt-4 border-t border-white/5">
                            <div
                                class="flex items-center gap-3 p-3 bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl border border-white/5">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="text-xs text-slate-400">
                                    <span class="text-white font-bold">Pro Tip:</span> Use <span
                                        class="text-blue-400">CMD + K</span> to jump between Create Invoice and
                                    Projects instantly.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <livewire:command-palette />

    @livewireScripts
</body>

</html>
