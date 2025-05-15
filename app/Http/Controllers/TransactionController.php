<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
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

        $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.transaction', compact('transactions', 'search'));
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
            'status' => 'required|string',
            'pengiriman' => 'required|string',
            'pembayaran' => 'required|string',
        ]);

        Transactions::create([
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'invoice' => $request->invoice,
            'status' => $request->status,
            'pengiriman' => $request->pengiriman,
            'pembayaran' => $request->pembayaran,
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
    public function update(Request $request, Transactions $transaction)
    {
        $request->validate([
            'tanggal_pemesanan' => 'required|date',
            'invoice' => 'required|unique:transaksi,invoice,' . $transaction->id,
            'status' => 'required|string',
            'pengiriman' => 'required|string',
            'pembayaran' => 'required|string',
        ]);

        $transaction->update([
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'invoice' => $request->invoice,
            'status' => $request->status,
            'pengiriman' => $request->pengiriman,
            'pembayaran' => $request->pembayaran,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transactions $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil dihapus.');
    }
}
