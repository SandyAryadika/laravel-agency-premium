<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Tech Client (US Based)
        Client::create([
            'name' => 'Nebula Tech Innovations',
            'email' => 'accounts@nebula.io',
            'phone' => '+1 (415) 555-0198',
            'status' => 'active'
        ]);

        // Retail Client (UK Based)
        Client::create([
            'name' => 'Urban Sole Footwear',
            'email' => 'vendor.relations@urbansole.co.uk',
            'phone' => '+44 20 7946 0958',
            'status' => 'active'
        ]);

        // Corporate/Healthcare Client (Singapore Based)
        Client::create([
            'name' => 'Vitality Health Group',
            'email' => 'finance@vitality.sg',
            'phone' => '+65 6789 1234',
            'status' => 'inactive' // Churned client
        ]);
    }
}
