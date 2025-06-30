<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Shipment;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // --- Query untuk transaksi yang menunggu konfirmasi ---
        // Mengambil semua transaksi dengan status 'Belum Dibayar'
        $pendingPayments = Transactions::with('shipment')
            ->where('pembayaran', 'Belum Dibayar')
            ->orderBy('tanggal_pemesanan', 'asc') // Tampilkan yang paling lama dulu
            ->get();


        // --- Query untuk semua transaksi (dengan filter dan pagination) ---
        $query = Transactions::with('shipment');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('invoice', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $allTransactions = $query->orderBy('tanggal_pemesanan', 'desc')->paginate(10);

        // Ambil semua metode pengiriman untuk modal edit
        $shipments = Shipment::all();

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.transaction', [
            'pendingPayments' => $pendingPayments,
            'transactions' => $allTransactions,
            'search' => $search,
            'shipments' => $shipments,
        ]);
    }

    public function printAll()
    {
        $transactions = Transactions::orderBy('tanggal_pemesanan', 'desc')->get();
        $grandTotal = $transactions->sum('total');
        return view('admin.print-all', [
            'transactions' => $transactions,
            'grandTotal' => $grandTotal,
        ]);
    }

    public function detail($invoice)
    {
        $transaction = Transactions::with('details.product')
            ->where('invoice', $invoice)
            ->firstOrFail();
        $subtotal = $transaction->details->sum(function ($detail) {
            if ($detail->product) {
                return $detail->qty * $detail->product->price;
            }
            return 0;
        });
        return view('admin.detail', compact('transaction', 'subtotal'));
    }

    public function create()
    {
        return view('transaction.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pemesanan' => 'required|date',
            'invoice' => 'required|string|unique:transactions,invoice',
            'pengiriman' => 'required|string',
            'pembayaran' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        Transactions::create($validated);
        return redirect()->route('transaction.index')->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    public function show(Transactions $transaction)
    {
        return redirect()->route('transaction.detail', $transaction->invoice);
    }

    public function edit(Transactions $transaction)
    {
        return view('transaction.edit', compact('transaction'));
    }


    /**
     * Update the specified resource in storage.
     * Logika perhitungan total telah disempurnakan.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|exists:shipment_status,code',
            'pengiriman' => 'required|string|max:255',
            'pembayaran' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
        ]);

        $selectedShipment = Shipment::where('code', $validated['code'])->firstOrFail();

        $updateData = [
            'code'              => $validated['code'],
            'pengiriman' => $validated['pengiriman'],
            'pembayaran'        => $validated['pembayaran'],
            'cost'              => $validated['cost'],
        ];

        // 1. Muat relasi detail transaksi beserta produknya
        $transaction->load('details.product');
        $subtotal = $transaction->details->sum(fn($detail) => optional($detail->product)->price * $detail->qty);
        $newTotal = $subtotal + $validated['cost'];
        $updateData['total'] = $newTotal;

        // 4. Update transaksi dengan data yang sudah lengkap
        $transaction->update($updateData);

        return redirect()->route('transaction.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }
}
