<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $phone;
    public $status = 'active';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:clients,email',
        'phone' => 'nullable|numeric',
        'status' => 'required|in:active,inactive',
    ];

    public function save()
    {
        $this->validate();

        Client::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);

        return redirect()->route('clients.index');
    }

    public function render()
    {
        return view('livewire.clients.create');
    }
}
