<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Models\Carts;

class CheckoutController extends Controller
{

    public function detail()
    {
        $checkouts = Carts::with('product')->get();
        return view('checkout', compact('checkouts'));
    }

    public function index()
    {
        $user = auth()->user();

        // Ambil semua data cart milik user yang sedang login
        $checkouts = Carts::with([
            'product' => function ($query) {
                $query->select('id', 'sku', 'name', 'price', 'image'); // Pastikan 'id' ada untuk relasi
            }
        ])
            ->where('email', $user->email)
            ->get();

        // Tandai bahwa ini adalah checkout dari keranjang
        $checkout_type = 'cart';

        return view('checkout', [
            'checkouts' => $checkouts,
            'userAlamat' => $user->alamat,
            'checkout_type' => $checkout_type
        ]);
    }

//    public function index()
//    {
//        $user = auth()->user();
//
//        // Ambil semua data cart milik user yang sedang login, dengan detail produk
//        $checkouts = Carts::with([
//            'product' => function ($query) {
//                $query->select('sku', 'name', 'price', 'image');
//            }
//        ])
//            ->where('email', $user->email)
//            ->get();
//
//        return view('checkout', [
//            'checkouts' => $checkouts,
//            'userAlamat' => $user->alamat
//        ]);
//    }

    public function checkoutNow(Request $request)
    {
        // Validasi input dari URL
        $request->validate([
            'sku' => ['required', 'string', 'exists:products,sku'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $user = auth()->user();
        $sku = $request->input('sku');
        $qty = $request->input('qty');

        // Cari produk berdasarkan SKU
        $product = Products::where('sku', $sku)->firstOrFail();

        // Buat objek "checkout item" sementara yang strukturnya mirip dengan Carts
        // agar view `checkout.blade.php` bisa membacanya tanpa perubahan.
        $checkoutItem = new \stdClass();
        $checkoutItem->product = $product;
        $checkoutItem->qty = $qty;
        $checkoutItem->sku = $sku;
        // Kita tidak punya 'email' atau 'id' dari tabel Carts, tapi itu tidak masalah untuk tampilan

        // Kirim item ini ke view dalam sebuah array agar konsisten dengan metode index()
        $checkouts = collect([$checkoutItem]);

        // Tandai bahwa ini adalah checkout "Beli Sekarang"
        $checkout_type = 'now';

        return view('checkout', [
            'checkouts' => $checkouts,
            'userAlamat' => $user->alamat,
            'checkout_type' => $checkout_type
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'max:255'],
            'sku' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer', 'min:0'],
        ]);

        $checkout = Carts::where('sku', $validated['sku'])->first();

        if ($checkout) {
            // Jika sudah ada, tambahkan qty baru ke qty yang sudah ada
            $checkout->qty += $validated['qty'];
            $checkout->save();
        } else {
            // Jika belum ada, buat data baru
            Carts::create($validated);
        }

        return redirect()->route('checkout')->with('success', 'Produk berhasil ditambahkan!');
//        return back()->with('success', 'Product berhasil ditambahkan.');
    }

    public function process(Request $request)
    {
        // Logika untuk menyimpan data transaksi ke tabel Transactions
        // Anda perlu membedakan antara checkout 'cart' dan 'now'

        $user = auth()->user();

        if ($request->input('checkout_type') === 'now') {
            // Proses untuk satu item "Beli Sekarang"
            // Ambil data dari form
            $sku = $request->input('sku');
            $qty = $request->input('qty');
            $product = Products::where('sku', $sku)->firstOrFail();
            $total = $product->price * $qty;

            // Buat transaksi
            $transaction = Transactions::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'status' => 'pending',
                // ... kolom lain
            ]);

            // Tambahkan detail transaksi
            // TransactionDetails::create([...]);

        } else {
            // Proses untuk checkout dari keranjang
            $cartItems = Carts::where('email', $user->email)->get();
            // ... logika untuk membuat transaksi dari banyak item
            // ... setelah berhasil, kosongkan keranjang pengguna
            // Carts::where('email', $user->email)->delete();
        }

        return redirect()->route('home')->with('success', 'Transaksi berhasil dibuat!');
    }

}
