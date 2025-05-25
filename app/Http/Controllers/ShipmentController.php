<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        // Ambil semua data dari view
        $shipmentStatuses = ShipmentStatusView::all();

        // Atau filter data
        // $activePaymentStatuses = PaymentStatusView::where('code', 'active')->get();

        return view('admin.transactions.index', compact('shipmentStatuses'));
    }
}
