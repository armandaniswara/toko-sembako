<?php // File: app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Menampilkan halaman riwayat transaksi untuk pengguna yang sedang login.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melihat riwayat pesanan.');
        }

        $userEmail = Auth::user()->email;

        // --- PERUBAHAN: Query untuk 'awaitingShipment' telah dihapus ---

        // Query sekarang hanya mengambil semua riwayat pesanan milik pengguna
        $orders = Transactions::where('email', $userEmail)
            ->orderBy('tanggal_pemesanan', 'desc')
            ->paginate(10);

        // Hanya variabel 'orders' yang dikirim ke view
        return view('order.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan milik pengguna.
     */
    public function show($invoice)
    {
        // Ambil data transaksi berdasarkan invoice DAN email pengguna untuk keamanan.
        $transaction = Transactions::with('details.product')
            ->where('invoice', $invoice)
            ->where('email', Auth::user()->email)
            ->firstOrFail();

        // Hitung subtotal produk untuk ditampilkan di rincian.
        $subtotal = $transaction->details->sum(function ($detail) {
            return optional($detail->product)->price * $detail->qty;
        });

        return view('order.show', compact('transaction', 'subtotal'));
    }

    /**
     * Menampilkan halaman konfirmasi pesanan berhasil untuk pengguna.
     */
    public function success($invoice)
    {
        $transaction = Transactions::where('invoice', $invoice)
            ->where('email', Auth::user()->email)
            ->firstOrFail();

        return view('order.success', compact('transaction', ));
    }

    public function payment($invoice)
    {
        $transaction = Transactions::where('invoice', $invoice)
            ->where('email', Auth::user()->email)
            ->where('pembayaran', 'Belum Dibayar') // Pastikan hanya transaksi yang belum dibayar
            ->firstOrFail();

        // Di aplikasi nyata, data ini seharusnya diambil dari database (misal: dari tabel settings atau parameter)
        $adminBankAccounts = [
            'BCA' => '166099065 a/n Arman Daniswara',
        ];

        return view('order.payment', compact('transaction', 'adminBankAccounts'));
    }
}
