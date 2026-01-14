<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Models\Task;
use Livewire\Component;

class Show extends Component
{
    public Project $project;

    // Form Input untuk Quick Task
    public $newTaskTitle = '';

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    // Logic 1: Tambah Task Baru
    public function addTask()
    {
        $this->validate(['newTaskTitle' => 'required|min:3']);

        $this->project->tasks()->create([
            'title' => $this->newTaskTitle,
            'is_completed' => false
        ]);

        $this->newTaskTitle = ''; // Reset input
    }

    // Logic 2: Toggle Selesai/Belum
    public function toggleTask($taskId)
    {
        $task = Task::find($taskId);
        if ($task && $task->project_id === $this->project->id) {
            $task->update(['is_completed' => !$task->is_completed]);
        }
    }

    // Logic 3: Hapus Task
    public function deleteTask($taskId)
    {
        Task::where('id', $taskId)->where('project_id', $this->project->id)->delete();
    }

    // Logic 4: Hapus Project (Redirect ke Index)
    public function deleteProject()
    {
        $this->project->delete();
        return redirect()->route('projects.index');
    }

    public function render()
    {
        return view('livewire.projects.show', [
            // Ambil tasks, urutkan yang belum selesai di atas
            'tasks' => $this->project->tasks()->orderBy('is_completed', 'asc')->latest()->get()
        ]);
    }
}
