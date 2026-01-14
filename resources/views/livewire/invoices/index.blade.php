<div class="w-full">

    @if (session('success'))
        <div
            class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Invoices</h1>
            <p class="text-slate-400 mt-1 text-sm">Manage your billing, track payments, and revenue.</p>
        </div>

        <a href="{{ route('invoices.create') }}"
            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Invoice
        </a>
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
                class="block w-full pl-10 pr-3 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all"
                placeholder="Search invoices by number or project...">
        </div>

        <div class="w-full md:w-48">
            <select wire:model.live="status"
                class="block w-full pl-3 pr-10 py-2.5 bg-slate-900/50 border border-white/10 rounded-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all appearance-none cursor-pointer">
                <option value="all">All Status</option>
                <option value="draft">Draft</option>
                <option value="sent">Sent</option>
                <option value="paid">Paid</option>
            </select>
        </div>
    </div>

    <div class="flex flex-col space-y-3">
        @forelse($invoices as $invoice)
            @php
                // Logic Styling untuk Badge Status
                $statusStyles = [
                    'draft' => [
                        'class' => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
                        'label' => 'Draft',
                        'dot' => 'bg-slate-400',
                        'icon' => 'text-slate-400 bg-slate-500/5 border-slate-500/10',
                    ],
                    'sent' => [
                        'class' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                        'label' => 'Sent',
                        'dot' => 'bg-blue-400 animate-pulse',
                        'icon' => 'text-blue-400 bg-blue-500/5 border-blue-500/10',
                    ],
                    'paid' => [
                        'class' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                        'label' => 'Paid',
                        'dot' => 'bg-emerald-400',
                        'icon' => 'text-emerald-400 bg-emerald-500/5 border-emerald-500/10',
                    ],
                    'overdue' => [
                        'class' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
                        'label' => 'Overdue',
                        'dot' => 'bg-rose-400',
                        'icon' => 'text-red-400 bg-red-500/5 border-red-500/10',
                    ],
                ];

                $style = $statusStyles[$invoice->status] ?? $statusStyles['draft'];
            @endphp

            <div
                class="group relative bg-slate-900/40 border border-white/5 rounded-2xl hover:bg-slate-800/40 hover:border-white/10 transition-all duration-200">
                <div class="flex flex-col md:flex-row md:items-center p-4 gap-6 md:gap-4">

                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <div
                            class="w-10 h-10 rounded-lg border flex items-center justify-center shrink-0 {{ $style['icon'] }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div
                                class="text-sm font-bold text-white font-mono tracking-wide truncate group-hover:text-blue-400 transition-colors">
                                {{ $invoice->invoice_number }}
                            </div>
                            <div class="text-xs text-slate-500 truncate flex items-center gap-1.5 mt-0.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                    </path>
                                </svg>
                                {{ $invoice->project->name ?? 'Unknown Project' }}
                            </div>
                        </div>
                    </div>

                    <div
                        class="grid grid-cols-2 md:flex md:items-center gap-4 md:gap-8 w-full md:w-auto mt-2 md:mt-0 pl-[3.25rem] md:pl-0">

                        <div class="md:w-28">
                            <span
                                class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Status</span>
                            <div
                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium {{ $style['class'] }}">
                                <div class="w-1.5 h-1.5 rounded-full {{ $style['dot'] }}"></div>
                                <span>{{ $style['label'] }}</span>
                            </div>
                        </div>

                        <div class="md:w-32">
                            <span
                                class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-0.5">Amount</span>
                            <div class="text-sm font-bold text-white">
                                <span
                                    class="text-slate-500 font-normal mr-0.5">Rp</span>{{ number_format($invoice->amount, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="md:w-28">
                            <span
                                class="block text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-0.5">Due
                                Date</span>
                            <div
                                class="text-sm font-medium {{ $invoice->due_date->isPast() && $invoice->status !== 'paid' ? 'text-red-400' : 'text-slate-300' }}">
                                {{ $invoice->due_date->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="relative group/menu flex items-center gap-2 pl-[3.25rem] md:pl-0">

                        <button wire:click="sendEmail('{{ $invoice->id }}')"
                            wire:confirm="Send this invoice via email to client?"
                            class="p-1.5 text-slate-500 hover:text-indigo-400 hover:bg-white/5 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-wait"
                            title="Email to Client">

                            <svg wire:loading.remove wire:target="sendEmail('{{ $invoice->id }}')" class="w-5 h-5"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>

                            <svg wire:loading wire:target="sendEmail('{{ $invoice->id }}')"
                                class="animate-spin w-5 h-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>

                        <a href="{{ route('invoices.pdf', $invoice->id) }}" target="_blank"
                            class="p-1.5 text-slate-500 hover:text-emerald-400 hover:bg-white/5 rounded-lg transition-colors"
                            title="Download PDF">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </a>

                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                            class="p-1.5 text-slate-500 hover:text-blue-400 hover:bg-white/5 rounded-lg transition-colors"
                            title="Edit Invoice">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </a>

                    </div>

                </div>
            </div>
        @empty
            <div
                class="flex flex-col items-center justify-center py-20 bg-slate-900/30 border border-dashed border-white/5 rounded-2xl">
                <div class="w-16 h-16 bg-slate-800/50 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-white font-medium mb-1">No invoices found</h3>
                <p class="text-slate-500 text-sm mb-6">Create your first invoice to get started.</p>
                <a href="{{ route('invoices.create') }}"
                    class="px-4 py-2 bg-white/5 hover:bg-white/10 text-white text-sm font-medium rounded-lg border border-white/10 transition-all">
                    Create Invoice
                </a>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $invoices->links() }}
    </div>
</div>
