<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ambil 10 transaksi terbaru
        $transactions = Transactions::orderBy('created_at', 'desc')
            ->paginate(10);

        $totalUniqueCustomers = Transactions::distinct('name')->count();
        $totalTransactions= Transactions::count();
        $totalRevenue     = Transactions::sum('total'); // atau field revenue

        return view('admin.dashboard', compact(
            'transactions',
            'totalUniqueCustomers',
            'totalTransactions',
            'totalRevenue'
        ));
    }
}
