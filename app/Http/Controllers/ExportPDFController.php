<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportPDFController extends Controller
{
    public function index()
    {
        // Ambil semua data transaksi
        $transactions = Transaction::all();

        // Data yang akan dikirim ke tampilan
        $data = [
            'date' => now()->format('Y-m-d'), // Menggunakan format tanggal saat ini
            'transactions' => $transactions
        ];

        // Menghasilkan PDF dari tampilan transactionPDF.blade.php
        $pdf = Pdf::loadView('pdf.transaction', $data);

        // Mengunduh file PDF dengan nama 'transactionPDF.pdf'
        return $pdf->download('transactionPDF.pdf');
    }
}
