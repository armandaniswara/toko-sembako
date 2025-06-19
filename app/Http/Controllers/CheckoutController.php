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

        // Ambil semua data cart milik user yang sedang login, dengan detail produk
        $checkouts = Carts::with([
            'product' => function ($query) {
                $query->select('sku', 'name', 'price', 'image');
            }
        ])
            ->where('email', $user->email)
            ->get();

        return view('checkout', [
            'checkouts' => $checkouts,
            'userAlamat' => $user->alamat
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


//
//
//    public function store(Request $request)
//    {
//        $request->validate([
//            'nama_penerima' => 'required|string|max:255',
//            'telepon' => 'required|string|max:15',
//            'alamat_lengkap' => 'required|string',
//            'catatan' => 'nullable|string',
//            'cart_ids' => 'required|array', // Pastikan cart_ids dikirim
//            'shipping_option' => 'required|string',
//        ]);
//
//        $user = auth()->user();
//        $cartIds = $request->cart_ids;
//
//        // Gunakan DB Transaction untuk memastikan integritas data
//        DB::beginTransaction();
//        try {
//            // 1. Ambil item yang akan di-checkout (validasi ulang)
//            $itemsToCheckout = Carts::where('email', $user->email)->whereIn('id', $cartIds)->get();
//
//            // 2. Hitung ulang total di backend (prinsip keamanan)
//            $subtotal = $itemsToCheckout->sum(fn($item) => $item->product->price * $item->qty);
//            // Anda bisa tambahkan biaya pengiriman di sini
//            $shippingCost = 15000; // Contoh
//            $totalAmount = $subtotal + $shippingCost;
//
//            // 3. Simpan ke tabel 'orders' / 'transactions' (sesuaikan dengan skema db Anda)
//            // $order = Order::create([...]);
//
//            // 4. Pindahkan item dari 'carts' ke 'order_details'
//            // foreach($itemsToCheckout as $item) { ... }
//
//            // 5. Hapus item dari keranjang
//            Carts::whereIn('id', $cartIds)->where('email', $user->email)->delete();
//
//            DB::commit(); // Jika semua berhasil
//
//            // Redirect ke halaman sukses dengan membawa nomor order
//            return redirect()->route('checkout.success')->with('success', 'Pesanan berhasil dibuat!');
//
//        } catch (\Exception $e) {
//            DB::rollBack(); // Batalkan semua jika ada error
//            // Log::error($e->getMessage());
//            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
//        }
//    }
//
//    public function success()
//    {
//        return view('checkout-success'); // Buat view sederhana untuk ini
//    }
}
