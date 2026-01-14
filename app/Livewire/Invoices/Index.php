<?php

namespace App\Livewire\Invoices;

use App\Mail\InvoiceSent;
use App\Models\Invoice;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
    ];

    /**
     * Send Invoice via Email.
     * * NOTE FOR BUYER/DEVELOPER:
     * This feature requires SMTP configuration in your .env file.
     * Please ensure you have set MAIL_MAILER, MAIL_HOST, MAIL_USERNAME, and MAIL_PASSWORD.
     * Use 'log' driver for local testing without sending real emails.
     */
    public function sendEmail($invoiceId)
    {
        // 1. Load Data
        $invoice = Invoice::with('project.client')->find($invoiceId);

        // 2. Validation: Ensure Client & Email exist
        if (!$invoice || !$invoice->project || !$invoice->project->client || !$invoice->project->client->email) {
            session()->flash('error', 'Cannot send email. Client email is missing.');
            return;
        }

        try {
            // 3. Attempt to Send Email
            // Laravel will use the configuration from .env file
            Mail::to($invoice->project->client->email)->send(new InvoiceSent($invoice));

            // 4. Update Status if Draft
            if ($invoice->status === 'draft') {
                $invoice->update(['status' => 'sent']);
            }

            session()->flash('success', 'Invoice sent to ' . $invoice->project->client->email);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'description' => "Emailed Invoice #{$invoice->invoice_number} to {$invoice->project->client->name}",
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            // 5. Error Handling (Crucial for Buyers)
            // If the buyer hasn't configured SMTP, this block will catch the error
            // and show a friendly message instead of crashing the app.

            // Log error for debugging (optional)
            // \Log::error($e->getMessage());

            session()->flash('error', 'Failed to send email. Please check your SMTP/Mail settings in .env file.');
        }
    }

    public function render()
    {
        $query = Invoice::with(['project.client']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('invoice_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('project', function ($p) {
                        $p->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return view('livewire.invoices.index', [
            'invoices' => $query->latest()->paginate(10)
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }
}
