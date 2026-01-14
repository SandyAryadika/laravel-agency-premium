<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{
    public $email = '';

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        // Mengirim link reset ke email
        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            // Jika berhasil
            session()->flash('status', __($status));
            $this->email = ''; // Reset input
        } else {
            // Jika gagal (email tidak ditemukan, dll)
            $this->addError('email', __($status));
        }
    }

    public function render()
    {
        // Gunakan layout guest (kosong) yang sama dengan Login
        return view('livewire.auth.forgot-password')->layout('components.layouts.guest');
    }
}
