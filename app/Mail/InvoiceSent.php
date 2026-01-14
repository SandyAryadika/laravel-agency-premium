<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceSent extends Mailable
{
    use Queueable, SerializesModels;

    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice #' . $this->invoice->invoice_number . ' from ' . (Auth::user()->agency_name ?? 'Us'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice-sent',
        );
    }

    public function attachments(): array
    {

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $this->invoice,
            'agency' => Auth::user(),
        ]);

        return [
            Attachment::fromData(fn() => $pdf->output(), 'Invoice-' . $this->invoice->invoice_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
