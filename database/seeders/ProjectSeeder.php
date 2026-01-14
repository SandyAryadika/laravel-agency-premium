<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // TARGET SPESIFIK KE EMAIL LOGIN ANDA
        $user = User::where('email', 'architect@devscript.lab')->first();

        // Fallback: Jika user architect tidak ditemukan, ambil user pertama apapun
        if (!$user) {
            $user = User::first();
        }

        $client1 = Client::where('name', 'Nebula Tech Innovations')->first();
        $client2 = Client::where('name', 'Urban Sole Footwear')->first();

        // --- PROJECT 1 (IN PROGRESS) ---
        $p1 = Project::create([
            'user_id' => $user->id, // Project ini sekarang pasti milik The Architect
            'client_id' => $client1?->id,
            'name' => 'SaaS Analytics Dashboard Revamp',
            'description' => 'Complete UI/UX overhaul of the customer analytics platform using React and Tailwind CSS.',
            'status' => 'in_progress', // Pastikan status sesuai Livewire Controller
            'start_date' => now()->subDays(10),
            'due_date' => now()->addDays(45),
            'budget' => 125000000,
            'meta_data' => ['color' => 'indigo', 'priority' => 'high'],
        ]);

        Task::create(['project_id' => $p1->id, 'title' => 'Setup CI/CD Pipeline', 'is_completed' => true]);
        Task::create(['project_id' => $p1->id, 'title' => 'Design System Implementation', 'is_completed' => true]);

        // --- PROJECT 2 (PENDING) ---
        $p2 = Project::create([
            'user_id' => $user->id,
            'client_id' => $client2?->id,
            'name' => 'Urban Sole Mobile App',
            'description' => 'Developing a Flutter-based mobile application with AR shoe try-on feature.',
            'status' => 'pending',
            'start_date' => now()->subDays(2),
            'due_date' => now()->addMonths(2),
            'budget' => 200000000,
            'meta_data' => ['color' => 'orange', 'priority' => 'normal'],
        ]);

        Task::create(['project_id' => $p2->id, 'title' => 'Requirement Gathering', 'is_completed' => true]);

        // --- PROJECT 3 (COMPLETED) ---
        $p3 = Project::create([
            'user_id' => $user->id,
            'name' => 'Internal CRM Migration',
            'description' => 'Migrating legacy client data to the new CRM system.',
            'status' => 'completed',
            'start_date' => now()->subMonths(2),
            'due_date' => now()->subDays(5),
            'budget' => 50000000,
            'meta_data' => ['color' => 'gray', 'priority' => 'low'],
        ]);
    }
}
