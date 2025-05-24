<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        // Ambil semua data dari view
        $paymentStatuses = PaymentStatusView::all();

        // Atau filter data
        // $activePaymentStatuses = PaymentStatusView::where('code', 'active')->get();

        return view('admin.transactions.index', compact('paymentStatuses'));
    }
}
