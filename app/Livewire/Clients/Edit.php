<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public Client $client;

    public $name;
    public $email;
    public $phone;
    public $status;

    public function mount(Client $client)
    {
        $this->client = $client;

        // Isi form dengan data lama
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->status = $client->status;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            // Email unik, tapi abaikan ID klien ini sendiri
            'email' => ['required', 'email', Rule::unique('clients')->ignore($this->client->id)],
            'phone' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $this->client->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);

        return redirect()->route('clients.index');
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
