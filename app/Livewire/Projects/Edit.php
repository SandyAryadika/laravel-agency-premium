<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class Edit extends Component
{
    public Project $project;

    // Property Form
    public $name;
    public $description;
    public $budget;
    public $due_date;
    public $status;

    public function mount(Project $project)
    {
        $this->project = $project;

        // Isi form dengan data lama (Pre-fill)
        $this->name = $project->name;
        $this->description = $project->description;
        $this->budget = $project->budget;
        $this->due_date = $project->due_date ? $project->due_date->format('Y-m-d') : null;
        $this->status = $project->status;
    }

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|max:500',
        'budget' => 'required|numeric|min:0',
        'due_date' => 'required|date',
        'status' => 'required|in:active,completed,archived',
    ];

    public function update()
    {
        $this->validate();

        $this->project->update([
            'name' => $this->name,
            'description' => $this->description,
            'budget' => $this->budget,
            'due_date' => $this->due_date,
            'status' => $this->status,
        ]);

        // Redirect kembali ke halaman detail (Show)
        return redirect()->route('projects.show', $this->project->id);
    }

    public function render()
    {
        return view('livewire.projects.edit');
    }
}
