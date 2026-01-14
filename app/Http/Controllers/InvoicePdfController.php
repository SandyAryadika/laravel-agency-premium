<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF Facade
use Illuminate\Support\Facades\Auth;

class InvoicePdfController extends Controller
{
    public function download(Invoice $invoice)
    {
        $agency = Auth::user();

        $invoice->load('project');

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'agency' => $agency,
        ]);

        $pdf->setPaper('a4', 'portrait');

        return $pdf->download($invoice->invoice_number . '.pdf');
    }
}
