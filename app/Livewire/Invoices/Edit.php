<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public Invoice $invoice;

    // Properties Form
    public $project_id;
    public $invoice_number;
    public $amount;
    public $issue_date;
    public $due_date;
    public $status;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;

        // Isi form dengan data yang ada
        $this->project_id = $invoice->project_id;
        $this->invoice_number = $invoice->invoice_number;
        $this->amount = $invoice->amount;
        // Format tanggal agar terbaca oleh input type="date"
        $this->issue_date = $invoice->issue_date->format('Y-m-d');
        $this->due_date = $invoice->due_date->format('Y-m-d');
        $this->status = $invoice->status;
    }

    public function update()
    {
        $this->validate([
            'project_id' => 'required|exists:projects,id',
            // Validasi Unik: Boleh sama jika itu milik invoice ini sendiri
            'invoice_number' => ['required', Rule::unique('invoices')->ignore($this->invoice->id)],
            'amount' => 'required|numeric|min:0',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|in:draft,sent,paid,overdue',
        ]);

        $this->invoice->update([
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
        return view('livewire.invoices.edit', [
            'projects' => Project::all()
        ]);
    }
}
