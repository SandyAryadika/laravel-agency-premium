<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // Wajib untuk upload file
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Settings extends Component
{
    use WithFileUploads;

    public $agency_name;
    public $agency_email;
    public $agency_address;
    public $tagline;
    public $photo;
    public $existingLogo;

    public function mount()
    {
        $user = Auth::user();
        $this->agency_name = $user->agency_name;
        $this->agency_email = $user->agency_email;
        $this->agency_address = $user->agency_address;
        $this->tagline = $user->tagline;
        $this->existingLogo = $user->agency_logo;
    }

    public function save()
    {
        $this->validate([
            'agency_name' => 'required|string|max:255',
            'agency_email' => 'required|email',
            'agency_address' => 'nullable|string',
            'photo' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();
        $data = [
            'agency_name' => $this->agency_name,
            'agency_email' => $this->agency_email,
            'agency_address' => $this->agency_address,
            'tagline' => $this->tagline,
        ];

        if ($this->photo) {
            if ($user->agency_logo) {
                Storage::disk('public')->delete($user->agency_logo);
            }

            $path = $this->photo->store('logos', 'public');
            $data['agency_logo'] = $path;
        }

        $user->update($data);

        $this->photo = null;
        $this->existingLogo = $user->agency_logo;

        session()->flash('success', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.settings');
    }
}
