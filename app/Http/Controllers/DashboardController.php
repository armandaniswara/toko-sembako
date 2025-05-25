<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil 10 transaksi terbaru
        $transactions = Transactions::orderBy('created_at', 'desc')
            ->paginate(10);

        // ambil statistik kartu (contoh)
//        $totalUsers       = User::count();
//        $totalTransactions= Transactions::count();
//        $totalRevenue     = Transactions::sum('pembayaran'); // atau field revenue

        return view('admin.dashboard', compact(
            'transactions',
//            'totalUsers',
//            'totalTransactions',
//            'totalRevenue'
        ));
    }
}
