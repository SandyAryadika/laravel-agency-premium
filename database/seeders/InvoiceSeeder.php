<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil Project berdasarkan nama untuk memastikan konteksnya benar
        $project1 = Project::where('name', 'SaaS Analytics Dashboard Revamp')->first();
        $project2 = Project::where('name', 'Urban Sole Mobile App (iOS/Android)')->first();

        // 1. Invoice untuk Project 1 (Down Payment - PAID)
        if ($project1) {
            Invoice::create([
                'project_id' => $project1->id,
                'invoice_number' => 'INV-2024-001',
                'amount' => 62500000, // 50% DP
                'status' => 'paid',
                'issue_date' => now()->subDays(10),
                'due_date' => now()->subDays(3), // Sudah lewat tapi sudah dibayar
            ]);

            // Milestone 1 (SENT - Belum dibayar)
            Invoice::create([
                'project_id' => $project1->id,
                'invoice_number' => 'INV-2024-005',
                'amount' => 30000000,
                'status' => 'sent',
                'issue_date' => now()->subDays(1),
                'due_date' => now()->addDays(14),
            ]);
        }

        // 2. Invoice untuk Project 2 (Consultation Fee - OVERDUE)
        if ($project2) {
            Invoice::create([
                'project_id' => $project2->id,
                'invoice_number' => 'INV-2024-002',
                'amount' => 15000000,
                'status' => 'overdue',
                'issue_date' => now()->subMonth(),
                'due_date' => now()->subDays(5),
            ]);
        }
    }
}
