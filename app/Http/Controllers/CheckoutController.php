<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Products;
use App\Models\Shipment;
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

        $payments = Payment::all();
        $shipments = Shipment::all();

        return view('checkout', [
            'checkouts' => $checkouts,
            'payments' => $payments,
            'shipments' => $shipments,
            'userAlamat' => $user->alamat,
            'checkout_type' => $checkout_type
        ]);
    }

    public function checkoutNow(Request $request)
    {
        // Validasi input dari URL
        $request->validate([
            'sku' => ['required', 'string', 'exists:products,sku'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);
        $payments = Payment::all();
        $shipments = Shipment::all();
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
            'payments' => $payments,
            'shipments' => $shipments,
            'userAlamat' => $user->alamat,
            'checkout_type' => $checkout_type
        ]);
    }

    public function checkoutSelected(Request $request)
    {
        // 1. Validasi input: pastikan 'cart_selected' ada dan merupakan sebuah array
        $validated = $request->validate([
            'cart_selected' => ['required', 'array', 'min:1'],
            'cart_selected.*' => ['string', 'exists:products,sku'], // Pastikan setiap isinya adalah SKU yang valid
        ]);

        $payments = Payment::all();
        $shipments = Shipment::all();
        $user = auth()->user();
        $selectedSkus = $validated['cart_selected'];

        // 2. Ambil data lengkap (termasuk qty) dari keranjang HANYA untuk item yang SKU-nya dipilih
        $checkouts = Carts::with([
            'product' => function ($query) {
                $query->select('id', 'sku', 'name', 'price', 'image');
            }
        ])
            ->where('email', $user->email) // atau ->where('user_id', $user->id)
            ->whereIn('sku', $selectedSkus) // Ini bagian pentingnya!
            ->get();

        // Jika karena suatu alasan tidak ada data yang cocok (misal, user buka 2 tab), kembali ke keranjang
        if ($checkouts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        // 3. Tampilkan halaman checkout dengan data yang sudah difilter
        return view('checkout', [
            'checkouts' => $checkouts,
            'payments' => $payments,
            'shipments' => $shipments,
            'userAlamat' => $user->alamat,
            'checkout_type' => 'selected' // Kita bisa gunakan tipe baru jika perlu logika berbeda di view checkout
        ]);
    }

    public function store(Request $request)
    {

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
