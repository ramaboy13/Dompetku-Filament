<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportPDFController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dari query string, default ke bulan saat ini
        $month = $request->query('month', now()->format('m'));
        $year = $request->query('year', now()->format('Y'));

        // Filter transaksi berdasarkan bulan dan tahun
        $transactions = Transaction::whereYear('date_transaction', $year)
            ->whereMonth('date_transaction', $month)
            ->get();

        // Data yang akan dikirim ke tampilan
        $data = [
            'date' => now()->format('Y-m-d'),
            'transactions' => $transactions,
            'month' => $month,
            'year' => $year,
        ];

        // Menghasilkan PDF dari tampilan transactionPDF.blade.php
        $pdf = Pdf::loadView('pdf.transaction', $data);

        // Mengunduh file PDF dengan nama 'transactionPDF.pdf'
        return $pdf->download("transactionPDF_{$year}_{$month}.pdf");
    }
}
