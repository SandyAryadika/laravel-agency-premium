<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Project;
use Livewire\Component;

class CommandPalette extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        $this->results = [];

        if (strlen($this->search) < 2) {
            return;
        }

        // 1. SEARCH PAGES / ACTIONS (Menu Navigasi)
        $pages = [
            ['title' => 'Dashboard', 'route' => route('dashboard'), 'icon' => 'Home', 'group' => 'Pages'],
            ['title' => 'Invoices', 'route' => route('invoices.index'), 'icon' => 'Document', 'group' => 'Pages'],
            ['title' => 'Create Invoice', 'route' => route('invoices.create'), 'icon' => 'Plus', 'group' => 'Actions'],
            ['title' => 'Projects', 'route' => route('projects.index'), 'icon' => 'Folder', 'group' => 'Pages'],
            ['title' => 'Create Project', 'route' => route('projects.create'), 'icon' => 'Plus', 'group' => 'Actions'],
            ['title' => 'Clients', 'route' => route('clients.index'), 'icon' => 'Users', 'group' => 'Pages'],
            ['title' => 'Add Client', 'route' => route('clients.create'), 'icon' => 'Plus', 'group' => 'Actions'],
            ['title' => 'Settings', 'route' => route('settings'), 'icon' => 'Cog', 'group' => 'Pages'],
        ];

        foreach ($pages as $page) {
            if (stripos($page['title'], $this->search) !== false) {
                $this->results[] = $page;
            }
        }

        // 2. SEARCH PROJECTS (Database)
        $projects = Project::where('user_id', auth()->id())
            ->where('name', 'like', '%' . $this->search . '%')
            ->take(3)
            ->get();

        foreach ($projects as $project) {
            $this->results[] = [
                'title' => $project->name,
                'route' => route('projects.edit', $project->id),
                'icon' => 'FolderOpen',
                'group' => 'Projects'
            ];
        }

        // 3. SEARCH CLIENTS (Database)
        $clients = Client::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->take(3)
            ->get();

        foreach ($clients as $client) {
            $this->results[] = [
                'title' => $client->name,
                'route' => route('clients.edit', $client->id),
                'icon' => 'User',
                'group' => 'Clients'
            ];
        }
    }

    public function render()
    {
        return view('livewire.command-palette');
    }
}
