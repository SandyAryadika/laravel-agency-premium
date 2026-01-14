<div class="w-full">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Expenses</h1>
            <p class="text-slate-400 mt-1 text-sm">Track every penny to maximize profit.</p>
        </div>

        <button wire:click="openModal"
            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-blue-600/20 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>
            </svg>
            Record Expense
        </button>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-slate-900/50 border border-white/5 rounded-3xl overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-white/5 text-xs text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Date</th>
                    <th class="px-6 py-4 font-semibold">Description / Category</th>
                    <th class="px-6 py-4 font-semibold">Receipt</th>
                    <th class="px-6 py-4 font-semibold text-right">Amount</th>
                    <th class="px-6 py-4 font-semibold text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($expenses as $expense)
                    <tr class="group hover:bg-slate-800/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400">
                            {{ $expense->date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-white">{{ $expense->description }}</div>
                            <div
                                class="mt-1 inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-slate-700 text-slate-300 border border-slate-600 uppercase">
                                {{ $expense->category }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if ($expense->receipt_path)
                                <a href="{{ asset('storage/' . $expense->receipt_path) }}" target="_blank"
                                    class="flex items-center gap-2 text-xs text-blue-400 hover:underline hover:text-blue-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                    View Receipt
                                </a>
                            @else
                                <span class="text-xs text-slate-600 italic">No receipt</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <span class="text-blue-400 font-bold">- Rp
                                {{ number_format($expense->amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="delete({{ $expense->id }})"
                                wire:confirm="Are you sure you want to delete this expense?"
                                class="text-slate-500 hover:text-blue-400 transition-colors p-2 rounded-lg hover:bg-white/5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            No expenses recorded yet. Good for wallet, bad for data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4 border-t border-white/5">
            {{ $expenses->links() }}
        </div>
    </div>


    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/80 backdrop-blur-sm">
            <div
                class="bg-slate-900 border border-white/10 w-full max-w-lg rounded-2xl shadow-2xl p-6 relative animate-fade-in-up">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-white">Record New Expense</h3>
                    <button wire:click="closeModal" class="text-slate-500 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-4">

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Description</label>
                        <input wire:model="description" type="text" placeholder="e.g. Server Cost January"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                        @error('description')
                            <span class="text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label
                            class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Category</label>
                        <select wire:model="category"
                            class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Amount
                                (IDR)</label>
                            <input wire:model="amount" type="number" placeholder="500000"
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                            @error('amount')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Date</label>
                            <input wire:model="date" type="date"
                                class="w-full bg-slate-800/50 border border-white/10 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 [color-scheme:dark]">
                            @error('date')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Receipt
                            (Optional)</label>
                        <div class="flex items-center gap-4">
                            <label
                                class="flex items-center gap-2 px-4 py-2 bg-slate-800 border border-white/10 rounded-lg cursor-pointer hover:bg-slate-700 transition-colors text-sm text-slate-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Upload Image</span>
                                <input type="file" wire:model="receipt" class="hidden">
                            </label>
                            <span wire:loading wire:target="receipt"
                                class="text-xs text-blue-400 animate-pulse">Uploading...</span>
                            @if ($receipt)
                                <span class="text-xs text-emerald-400">File Selected</span>
                            @endif
                        </div>
                        @error('receipt')
                            <span class="text-xs text-red-400">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-slate-400 hover:text-white">Cancel</button>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold rounded-xl shadow-lg shadow-blue-600/20 transition-all">
                            Save Expense
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

</div>
