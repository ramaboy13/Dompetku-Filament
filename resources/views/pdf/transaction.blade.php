<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .header h2 {
            color: #2c3e50;
            margin: 0;
            font-size: 24px;
        }

        .company-info {
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            padding: 12px;
            font-weight: bold;
            text-align: left;
        }

        td {
            padding: 10px;
            color: #444;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .amount {
            text-align: right;
            font-family: monospace;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .total-table {
            width: 300px;
            margin-left: auto;
            margin-right: 0;
        }

        .total-table td {
            padding: 5px 10px;
        }

        .total-table tr:last-child {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        @page {
            margin: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Transaction Invoice</h2>
    </div>

    {{-- <div class="company-info">
        <h3>Your Company Name</h3>
        <p>123 Business Street</p>
        <p>City, Country, ZIP</p>
        <p>Phone: (123) 456-7890</p>
        <p>Email: contact@yourcompany.com</p>
    </div> --}}

    <div class="invoice-details">
        <p><strong>Date Export:</strong> {{ $date }}</p>
        <p><strong>Generated By:</strong> {{ auth()->user()->name ?? 'System' }}</p>
        <p><strong>Reference:</strong> INV-{{ date('Ymd') }}-{{ rand(1000, 9999) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Category</th>
                <th>Bank</th>
                <th>Description</th>
                <th>Date</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->category->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->bank->bank ?? 'N/A' }}</td>
                    <td>{{ $transaction->description ?? 'N/A' }}</td>
                    <td>{{ date('d M Y', strtotime($transaction->date_transaction)) }}</td>
                    <td class="amount">{{ number_format($transaction->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <table class="total-table">
            <tr>
                <td>Subtotal:</td>
                <td class="amount">{{ number_format($transactions->sum('amount'), 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total Amount:</strong></td>
                <td class="amount"><strong>{{ number_format($transactions->sum('amount'), 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
        <p>For any queries regarding this invoice, please contact our support team.</p>
        <p>Thank you for your business!</p>
    </div>
</body>

</html>
