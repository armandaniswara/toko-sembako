<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userEmail = auth()->user()->email; // Ambil email user yang sedang login
//        $carts = Carts::where('email', $userEmail)->get(); // Ambil carts berdasarkan email user
        $carts = Carts::with('product')
            ->where('email', $userEmail)
            ->get();

        return view('checkout', compact('carts'));
    }


    public function detail()
    {
        $carts = Carts::with('product')->get();

        return view('checkout', compact('carts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:0'],
        ]);

        $cart = Carts::where('sku', $validated['sku'])->first();

        if ($cart) {
            // Jika sudah ada, tambahkan qty baru ke qty yang sudah ada
            $cart->qty += $validated['qty'];
            $cart->save();
        } else {
            // Jika belum ada, buat data baru
            Carts::create($validated);
        }

        return back()->with('success', 'Product berhasil ditambahkan.');
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = Carts::find($request->cart_id);
        $cart->qty = $request->qty;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
    }

}
