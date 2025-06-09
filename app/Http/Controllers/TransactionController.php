<?php

namespace App\Http\Controllers;

use App\Models\Products;
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

        $query = Transactions::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('invoice', 'like', "%{$search}%");
            });
        }

        $transactions = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.transaction', compact('transactions', 'search'));
    }

    public function detail($invoice)
    {
        $transactions = TransactionsDetail::with(['product', 'transaction'])
            ->where('invoice', $invoice)
            ->get();

        // Jika data tidak ditemukan, redirect kembali dengan pesan error
        if ($transactions->isEmpty()) {
            return redirect()->back()->with('error', 'Data transaction_detail tidak ditemukan untuk invoice: ' . $invoice);
        }

        // Tambahkan kolom 'jumlah' untuk setiap item (product.price * qty)
        $transactions->transform(function ($item) {
            $price = $item->product->price ?? 0;
            $item->jumlah = $price * $item->qty;
            return $item;
        });

        // Hitung summary total dari seluruh 'jumlah'
        $totalSummary = $transactions->sum('jumlah');

        // Hitung summary total dari seluruh 'jumlah'
        $totalSummary = $transactions->sum('jumlah');

        return view('admin.detail', compact('transactions', 'totalSummary'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pemesanan' => 'required|date',
            'invoice' => 'required|unique:transaksi',
            'pengiriman' => 'required|string',
            'pembayaran' => 'required|string',
            'total' => 'required|numeric|min:0',
        ]);

        Transactions::create([
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'invoice' => $request->invoice,
            'pengiriman' => $request->pengiriman,
            'pembayaran' => $request->pembayaran,
            'total' => $request->price
        ]);

        return redirect()->route('transaction.index')->with('success', 'Data transaksi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transactions $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transactions $transaction)
    {
        return view('transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);


        $validated = $request->validate([
            'pengiriman' => 'required|string|max:255',
            'pembayaran' => 'required|string|max:255',
        ]);

        $transaction->update($validated);

        return redirect()->route('transaction.index')->with('success', 'Status transaksi berhasil diperbarui.');
    }


}
