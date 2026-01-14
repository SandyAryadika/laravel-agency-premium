<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        /* Reset & Base Styles */
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        /* Container styling */
        .container {
            width: 100%;
            padding: 20px;
        }

        /* Header Layout using Table */
        .header-table {
            width: 100%;
            margin-bottom: 40px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 20px;
        }

        .logo-cell {
            vertical-align: top;
            width: 50%;
        }

        .meta-cell {
            vertical-align: top;
            text-align: right;
            width: 50%;
        }

        /* Logo Styling */
        .logo {
            max-height: 80px;
            width: auto;
            object-fit: contain;
        }

        /* Agency Name Fallback (if no logo) */
        .agency-title {
            font-size: 24px;
            font-weight: bold;
            color: #111;
            margin: 0;
            text-transform: uppercase;
        }

        /* Invoice Meta */
        .invoice-label {
            font-size: 28px;
            font-weight: bold;
            color: #2563eb;
            /* Blue 600 */
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .meta-info {
            font-size: 13px;
            color: #555;
        }

        /* Address Section */
        .address-table {
            width: 100%;
            margin-bottom: 40px;
        }

        .addr-col {
            width: 50%;
            vertical-align: top;
        }

        .addr-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .addr-name {
            font-size: 15px;
            font-weight: bold;
            color: #111;
            margin-bottom: 2px;
        }

        .addr-details {
            font-size: 13px;
            color: #555;
            line-height: 1.5;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #f9fafb;
            color: #4b5563;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
        }

        .text-right {
            text-align: right;
        }

        .project-name {
            font-weight: bold;
            font-size: 14px;
            color: #111;
        }

        .project-desc {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        /* Total Section */
        .total-table {
            width: 100%;
            margin-top: 20px;
        }

        .total-label {
            font-size: 14px;
            font-weight: bold;
            color: #4b5563;
            text-align: right;
            padding-right: 20px;
        }

        .total-amount {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
            text-align: right;
        }

        /* Footer */
        .footer {
            margin-top: 60px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="container">

        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    @if (isset($agency) && $agency->agency_logo)
                        <img src="{{ public_path('storage/' . $agency->agency_logo) }}" class="logo">
                    @else
                        <h1 class="agency-title">{{ $agency->agency_name ?? config('app.name') }}</h1>
                    @endif
                </td>
                <td class="meta-cell">
                    <div class="invoice-label">INVOICE</div>
                    <div class="meta-info">
                        <strong>#{{ $invoice->invoice_number }}</strong><br>
                        Issue Date: {{ $invoice->issue_date->format('d M Y') }}<br>
                        Due Date: {{ $invoice->due_date->format('d M Y') }}
                    </div>
                </td>
            </tr>
        </table>

        <table class="address-table">
            <tr>
                <td class="addr-col">
                    <div class="addr-label">From</div>
                    <div class="addr-name">{{ $agency->agency_name ?? $agency->name }}</div>
                    <div class="addr-details">
                        {{ $agency->agency_email ?? $agency->email }}<br>
                        {!! nl2br(e($agency->agency_address ?? '')) !!}
                    </div>
                </td>

                <td class="addr-col">
                    <div class="addr-label">To</div>
                    <div class="addr-name">{{ $invoice->project->client->name ?? 'Client Name' }}</div>
                    <div class="addr-details">
                        {{ $invoice->project->client->email ?? '' }}<br>
                        {{ $invoice->project->client->phone ?? '' }}
                    </div>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th width="70%">Description</th>
                    <th width="30%" class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="project-name">{{ $invoice->project->name }}</div>
                        <div class="project-desc">{{ $invoice->project->description ?? 'Project services rendered.' }}
                        </div>
                    </td>
                    <td class="text-right">
                        Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="total-table">
            <tr>
                <td class="total-label">Total Amount Due</td>
                <td class="total-amount">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            <p>Thank you for your business!</p>
            <p>
                {{ $agency->agency_name ?? $agency->name }}
                @if ($agency->agency_email)
                    | {{ $agency->agency_email }}
                @endif
            </p>
        </div>

    </div>

</body>

</html>
