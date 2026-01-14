<?php

namespace App\Livewire\Projects;

use App\Models\Client;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    // Properti Form Project
    public $name;
    public $description;
    public $end_date;
    public $status = 'pending';
    public $client_id;

    protected $rules = [
        'name' => 'required|min:3',
        'client_id' => 'required|exists:clients,id',
        'description' => 'nullable|string',
        'end_date' => 'nullable|date',
        'status' => 'required|in:pending,active,completed',
    ];

    public function save()
    {
        $this->validate();

        Project::create([
            'user_id' => Auth::id(),
            'client_id' => $this->client_id,
            'name' => $this->name,
            'description' => $this->description,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        return redirect()->route('projects.index');
    }

    public function render()
    {
        return view('livewire.projects.create', [
            'clients' => Client::where('status', 'active')->orderBy('name')->get()
        ]);
    }
}
