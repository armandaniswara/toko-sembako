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

        return view('cart', compact('carts'));
    }


    public function detail()
    {
        $carts = Carts::with('product')->get();
        return view('cart', compact('carts'));
    }

    public function store(Request $request)
    {
        // Validasi sekarang menyertakan email dari form
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'sku'   => ['required', 'string', 'exists:products,sku'],
            'qty'   => ['required', 'integer', 'min:1'],
        ]);

        // Cari item yang ada berdasarkan email DAN sku
        $cart = Carts::where('email', $validated['email'])
            ->where('sku', $validated['sku'])
            ->first();

        if ($cart) {
            $cart->qty += $validated['qty'];
            $cart->save();
        } else {
            Carts::create($validated);
        }

        // Jika ini adalah request AJAX
        if ($request->wantsJson()) {
            // Hitung jumlah keranjang baru berdasarkan email
            $newCartCount = Carts::where('email', $validated['email'])->count();

            return response()->json([
                'success'   => true,
                'message'   => 'Produk berhasil ditambahkan!',
                'cartCount' => $newCartCount
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }


    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ]);

        // Ganti pengecekan kepemilikan dari user_id kembali ke email
        $cart = Carts::where('id', $request->cart_id)
            ->where('email', auth()->user()->email)
            ->first();

        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Item keranjang tidak ditemukan.'], 404);
        }

        $cart->qty = $request->qty;
        $cart->save();

        return response()->json(['success' => true, 'message' => 'Quantity updated successfully']);
    }


}
