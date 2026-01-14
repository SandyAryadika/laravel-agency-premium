<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // HAPUS BARIS User::truncate(); KARENA INI PENYEBAB ERRORNYA.
        // Saat migrate:fresh dijalankan, database sudah otomatis kosong & ID reset ke 1.

        // 1. Buat Akun Utama (Otomatis jadi ID 1)
        User::factory()->create([
            'name' => 'The Architect',
            'email' => 'architect@devscript.lab',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'agency_name' => 'DevScript Lab',
            'agency_address' => 'Silicon Valley, CA',
            'tagline' => 'Fullstack Mastermind'
        ]);

        // 2. Panggil seeder lainnya
        $this->call([
            ClientSeeder::class,
            ProjectSeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}
