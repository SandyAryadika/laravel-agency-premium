<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all'; // Default: Tampilkan semua

    public function render()
    {
        $query = Client::query();

        // 1. Logic Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        // 2. Logic Filter Status
        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return view('livewire.clients.index', [
            'clients' => $query->latest()->paginate(9)
        ]);
    }

    // Reset halaman saat filter berubah
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedStatus()
    {
        $this->resetPage();
    }
}
