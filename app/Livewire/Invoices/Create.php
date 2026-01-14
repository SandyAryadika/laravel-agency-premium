<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $project_id = '';
    public $invoice_number;
    public $amount;
    public $issue_date;
    public $due_date;
    public $status = 'draft';

    public function mount()
    {
        // Set Default Tanggal
        $this->issue_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(7)->format('Y-m-d');

        // Auto-Generate Nomor Invoice (Format: INV-TAHUN-URUTAN)
        // Contoh: INV-2026-005
        $count = Invoice::count() + 1;
        $this->invoice_number = 'INV-' . now()->year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }

    protected $rules = [
        'project_id' => 'required|exists:projects,id',
        'invoice_number' => 'required|unique:invoices,invoice_number',
        'amount' => 'required|numeric|min:0',
        'issue_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:issue_date',
        'status' => 'required|in:draft,sent,paid,overdue',
    ];

    public function save()
    {
        $this->validate();

        Invoice::create([
            'project_id' => $this->project_id,
            'invoice_number' => $this->invoice_number,
            'amount' => $this->amount,
            'status' => $this->status,
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
        ]);

        return redirect()->route('invoices.index');
    }

    public function render()
    {
        // Ambil semua project untuk dropdown
        return view('livewire.invoices.create', [
            'projects' => Project::all()
        ]);
    }
}
