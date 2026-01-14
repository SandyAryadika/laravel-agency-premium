<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        /* Header */
        .header {
            display: table;
            width: 100%;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header-left {
            display: table-cell;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            text-align: right;
            vertical-align: top;
        }

        .agency-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            /* Blue-600 */
            margin-bottom: 5px;
        }

        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #111;
            text-transform: uppercase;
        }

        /* Details Grid */
        .details-box {
            display: table;
            width: 100%;
            margin-bottom: 40px;
        }

        .from-box,
        .to-box {
            display: table-cell;
            width: 48%;
            vertical-align: top;
        }

        .label {
            font-size: 10px;
            color: #777;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            text-align: left;
            background-color: #f8f9fa;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
            text-transform: uppercase;
            color: #555;
        }

        .items-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .items-table .amount-col {
            text-align: right;
        }

        /* Total */
        .total-section {
            width: 100%;
            text-align: right;
        }

        .total-row {
            display: inline-block;
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .total-label {
            font-size: 12px;
            color: #555;
            margin-right: 15px;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #2563eb;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="header">
            <div class="header-left">
                <div class="agency-name">{{ $agency->agency_name ?? 'Your Agency' }}</div>
                <div>{{ $agency->agency_address ?? 'No Address Set' }}</div>
                <div>{{ $agency->agency_phone }}</div>
                <div>{{ $agency->email }}</div>
            </div>
            <div class="header-right">
                <div class="invoice-title">INVOICE</div>
                <div style="color: #777; margin-top: 5px;">#{{ $invoice->invoice_number }}</div>
                <div style="margin-top: 5px;">
                    <strong>Status:</strong>
                    <span
                        style="color: {{ $invoice->status == 'paid' ? 'green' : ($invoice->status == 'overdue' ? 'red' : '#555') }}; text-transform: uppercase;">
                        {{ $invoice->status }}
                    </span>
                </div>
            </div>
        </div>

        <div class="details-box">
            <div class="from-box">
                <div class="label">Billed To</div>
                <div style="font-weight: bold; font-size: 16px;">{{ $invoice->project->name }}</div>
                <div style="color: #555;">Project Client</div>
            </div>
            <div class="to-box" style="text-align: right;">
                <div class="label">Dates</div>
                <div><strong>Issue Date:</strong> {{ $invoice->issue_date->format('d M Y') }}</div>
                <div><strong>Due Date:</strong> {{ $invoice->due_date->format('d M Y') }}</div>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th width="60%">Description</th>
                    <th width="40%" class="amount-col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $invoice->project->name }}</strong><br>
                        <span style="color: #777; font-size: 12px;">Full payment for services rendered.</span>
                    </td>
                    <td class="amount-col">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">TOTAL DUE</span>
                <span class="total-amount">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for your business.</p>
            @if ($agency->agency_name)
                <p>&copy; {{ date('Y') }} {{ $agency->agency_name }}. All rights reserved.</p>
            @endif
        </div>

    </div>
</body>

</html>
