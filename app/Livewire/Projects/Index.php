<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\ActivityLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Index extends Component
{
    public $search = '';

    /**
     * Update Status Project (Drag & Drop Handler)
     */
    public function updateStatus($projectId, $newStatus)
    {
        // Cari project milik user yang sedang login
        $project = Project::where('user_id', Auth::id())->find($projectId);

        if ($project) {
            $oldStatus = $project->status;

            // Cek agar tidak update/log jika statusnya sama
            if ($oldStatus !== $newStatus) {
                $project->update(['status' => $newStatus]);

                // Format status agar enak dibaca (misal: "in_progress" jadi "In Progress")
                $readableStatus = Str::title(str_replace('_', ' ', $newStatus));

                // Catat di Activity Log
                ActivityLog::create([
                    'user_id' => Auth::id(),
                    'description' => "Moved project '{$project->name}' to {$readableStatus}",
                    'type' => 'info',
                ]);
            }
        }
    }

    public function render()
    {
        // 1. Base Query (Milik User)
        $query = Project::where('user_id', Auth::id());

        // 2. Filter Search (Jika ada ketikan)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%'); // Tambah cari di deskripsi juga
            });
        }

        // 3. Ambil Data Berdasarkan Status (PENTING: Gunakan 'in_progress' bukan 'active')
        // Menggunakan clone $query agar filter search tetap terbawa ke semua status

        $pendingProjects = (clone $query)
            ->where('status', 'pending')
            ->latest()
            ->get();

        $inProgressProjects = (clone $query)
            ->where('status', 'in_progress') // <--- PERBAIKAN DISINI (Sesuai Seeder)
            ->latest()
            ->get();

        $completedProjects = (clone $query)
            ->where('status', 'completed')
            ->latest()
            ->get();

        return view('livewire.projects.index', [
            'pendingProjects'    => $pendingProjects,
            'inProgressProjects' => $inProgressProjects, // Variable kita namakan inProgressProjects
            'completedProjects'  => $completedProjects
        ]);
    }
}
