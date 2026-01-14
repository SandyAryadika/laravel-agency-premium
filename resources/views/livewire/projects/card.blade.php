<div data-id="{{ $project->id }}"
    class="group cursor-move bg-slate-800/40 hover:bg-slate-700/60 border border-white/5 {{ $borderColor ?? 'border-white/5' }} p-4 rounded-xl shadow-sm hover:shadow-lg transition-all duration-200 select-none">

    <div class="flex justify-between items-start mb-2">
        <h4 class="font-bold text-white text-sm line-clamp-2 leading-snug group-hover:text-blue-400 transition-colors">
            {{ $project->name }}
        </h4>
        <a href="{{ route('projects.edit', $project->id) }}"
            class="text-slate-500 hover:text-white opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                </path>
            </svg>
        </a>
    </div>

    <div class="text-xs text-slate-500 mb-4 flex items-center gap-1.5">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
            </path>
        </svg>
        <span class="truncate max-w-[150px]">{{ $project->client->name ?? 'Unknown Client' }}</span>
    </div>

    <div class="flex items-center justify-between pt-3 border-t border-white/5">
        <div
            class="flex items-center gap-1.5 text-xs {{ $project->end_date && $project->end_date->isPast() && $project->status != 'completed' ? 'text-red-400' : 'text-slate-400' }}">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            {{ $project->end_date ? $project->end_date->format('M d') : 'No Date' }}
        </div>

        <div class="text-xs font-semibold text-slate-300">
            {{-- Rp {{ number_format($project->budget, 0, ',', '.') }} --}}
        </div>
    </div>
</div>
