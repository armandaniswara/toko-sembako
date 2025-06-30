<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Products;
use App\Models\Shipment;
use App\Models\Transactions;
use App\Models\TransactionsDetail;
use Illuminate\Http\Request;
use App\Models\Carts;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
//
//class CheckoutController extends Controller
//{
//
//    public function detail()
//    {
//        $checkouts = Carts::with('product')->get();
//        return view('checkout', compact('checkouts'));
//    }
//
//    public function index()
//    {
//        $user = auth()->user();
//
//        // Ambil semua data cart milik user yang sedang login
//        $checkouts = Carts::with([
//            'product' => function ($query) {
//                $query->select('id', 'sku', 'name', 'price', 'image'); // Pastikan 'id' ada untuk relasi
//            }
//        ])
//            ->where('email', $user->email)
//            ->get();
//
//        // Tandai bahwa ini adalah checkout dari keranjang
//        $checkout_type = 'cart';
//
//        $payments = Payment::all();
//        $shipments = Shipment::all();
//
//        return view('checkout', [
//            'checkouts' => $checkouts,
//            'payments' => $payments,
//            'shipments' => $shipments,
//            'userAlamat' => $user->alamat,
//            'checkout_type' => $checkout_type
//        ]);
//    }
//
//    public function checkoutNow(Request $request)
//    {
//        // Validasi input dari URL
//        $request->validate([
//            'sku' => ['required', 'string', 'exists:products,sku'],
//            'qty' => ['required', 'integer', 'min:1'],
//        ]);
//        $payments = Payment::all();
//        $shipments = Shipment::all();
//        $user = auth()->user();
//        $sku = $request->input('sku');
//        $qty = $request->input('qty');
//
//        // Cari produk berdasarkan SKU
//        $product = Products::where('sku', $sku)->firstOrFail();
//
//        // Buat objek "checkout item" sementara yang strukturnya mirip dengan Carts
//        // agar view `checkout.blade.php` bisa membacanya tanpa perubahan.
//        $checkoutItem = new \stdClass();
//        $checkoutItem->product = $product;
//        $checkoutItem->qty = $qty;
//        $checkoutItem->sku = $sku;
//        // Kita tidak punya 'email' atau 'id' dari tabel Carts, tapi itu tidak masalah untuk tampilan
//
//        // Kirim item ini ke view dalam sebuah array agar konsisten dengan metode index()
//        $checkouts = collect([$checkoutItem]);
//
//
//        // Tandai bahwa ini adalah checkout "Beli Sekarang"
//        $checkout_type = 'now';
//
//        return view('checkout', [
//            'checkouts' => $checkouts,
//            'payments' => $payments,
//            'shipments' => $shipments,
//            'userAlamat' => $user->alamat,
//            'checkout_type' => $checkout_type
//        ]);
//    }
//
//    public function checkoutSelected(Request $request)
//    {
//        // 1. Validasi input: pastikan 'cart_selected' ada dan merupakan sebuah array
//        $validated = $request->validate([
//            'cart_selected' => ['required', 'array', 'min:1'],
//            'cart_selected.*' => ['string', 'exists:products,sku'], // Pastikan setiap isinya adalah SKU yang valid
//        ]);
//
//        $payments = Payment::all();
//        $shipments = Shipment::all();
//        $user = auth()->user();
//        $selectedSkus = $validated['cart_selected'];
//
//        // 2. Ambil data lengkap (termasuk qty) dari keranjang HANYA untuk item yang SKU-nya dipilih
//        $checkouts = Carts::with([
//            'product' => function ($query) {
//                $query->select('id', 'sku', 'name', 'price', 'image');
//            }
//        ])
//            ->where('email', $user->email) // atau ->where('user_id', $user->id)
//            ->whereIn('sku', $selectedSkus) // Ini bagian pentingnya!
//            ->get();
//
//        // Jika karena suatu alasan tidak ada data yang cocok (misal, user buka 2 tab), kembali ke keranjang
//        if ($checkouts->isEmpty()) {
//            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan.');
//        }
//
//        // 3. Tampilkan halaman checkout dengan data yang sudah difilter
//        return view('checkout', [
//            'checkouts' => $checkouts,
//            'payments' => $payments,
//            'shipments' => $shipments,
//            'userAlamat' => $user->alamat,
//            'checkout_type' => 'selected' // Kita bisa gunakan tipe baru jika perlu logika berbeda di view checkout
//        ]);
//    }
//
//    public function store(Request $request)
//    {
//
//    }
//
////    public function process(Request $request)
////    {
////        // Logika untuk menyimpan data transaksi ke tabel Transactions
////        // Anda perlu membedakan antara checkout 'cart' dan 'now'
////
////        $user = auth()->user();
////
////        if ($request->input('checkout_type') === 'now') {
////            // Proses untuk satu item "Beli Sekarang"
////            // Ambil data dari form
////            $sku = $request->input('sku');
////            $qty = $request->input('qty');
////            $product = Products::where('sku', $sku)->firstOrFail();
////            $total = $product->price * $qty;
////
////            // Buat transaksi
////            $transaction = Transactions::create([
////                'user_id' => $user->id,
////                'total_amount' => $total,
////                'status' => 'pending',
////                // ... kolom lain
////            ]);
////
////            // Tambahkan detail transaksi
////            // TransactionDetails::create([...]);
////
////        } else {
////            // Proses untuk checkout dari keranjang
////            $cartItems = Carts::where('email', $user->email)->get();
////            // ... logika untuk membuat transaksi dari banyak item
////            // ... setelah berhasil, kosongkan keranjang pengguna
////            // Carts::where('email', $user->email)->delete();
////        }
////
////        return redirect()->route('home')->with('success', 'Transaksi berhasil dibuat!');
////    }
//
//    public function process(Request $request)
//    {
//        $user = auth()->user();
//
//        // 1. Validasi input
//        $validated = $request->validate([
//            'payment_method_code'  => ['required', 'string', 'exists:payment_status,code'],
//        ]);
//
//        // 2. Ambil data dari keranjang dan metode yang dipilih
//        $cartItems = Carts::with('product')->where('email', $user->email)->get();
//        if ($cartItems->isEmpty()) {
//            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
//        }
//
////        $shippingMethod = Shipment::where('code', $validated['shipping_method_code'])->firstOrFail();
////        $paymentMethod = \App\Models\Payment::where('code', $validated['payment_method_code'])->firstOrFail();
//
//        // 3. Hitung total dan buat nomor invoice unik
//        $productSubtotal = $cartItems->sum(fn($item) => $item->product->price * $item->qty);
//        $grandTotal = $productSubtotal ->cost;
//        $invoiceNumber = 'INV' . now()->format('Ymd') . strtoupper(Str::random(6));
//
//        // 4. Gunakan Database Transaction untuk keamanan data
//        $transaction = null;
//        DB::transaction(function () use ($user, $validated, $invoiceNumber, $cartItems, &$transaction) {
//
//            // A. Buat record di tabel 'transaction'
//            $transaction = Transactions::create([
//                'invoice'           => $invoiceNumber,
//                'name'              => $user->name, // Mengisi kolom 'name'
//                'total'             => $grandTotal, // Mengisi kolom 'total'
////                'metode_pembayaran'   => $paymentMethod->name, // Mengisi kolom 'pembayaran'
////                'pengiriman'        => $shippingMethod->name, // Mengisi kolom 'pengiriman'
//                'tanggal_pemesanan' => now(), // Mengisi kolom 'tanggal_pemesanan'
//                'pembayaran'            => 'Belum Dibayar', // Mengisi kolom 'status'
//                'pengiriman'    => 'Belum Dikirim'
//            ]);
//
//
//            // B. Buat record di tabel 'transaction_detail' untuk setiap item
//            foreach ($cartItems as $item) {
//                TransactionsDetail::create([
//                    'invoice' => $invoiceNumber,
//                    'sku'     => $item->product->sku,
//                    'qty'     => $item->qty,
//                    'total'   => $item->product->price * $item->qty, // Subtotal per item
//                ]);
//            }
//
//            // C. Kosongkan keranjang pengguna
//            Carts::where('email', $user->email)->delete();
//        });
//
//        // 5. Redirect ke halaman sukses atau pembayaran
//        // Di sini Anda bisa mengarahkan ke payment gateway jika ada
//        return redirect()->route('transaction.show', $transaction->id)->with('success', 'Pesanan dengan invoice ' . $invoiceNumber . ' berhasil dibuat!');
//    }
//
//}
class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout untuk semua item di keranjang.
     */
    public function index()
    {
        $user = auth()->user();
        $checkouts = Carts::with('product')->where('email', $user->email)->get();

        if ($checkouts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $totalPrice = $checkouts->sum(function($item) {
            return optional($item->product)->price * $item->qty;
        });


        return view('checkout', [
            'checkouts' => $checkouts,
            'payments' => Payment::all(),
            // 'shipments' => Shipment::all(), // Tidak lagi dibutuhkan
            'userAlamat' => $user->alamat,
            'checkout_type' => 'cart',
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Menampilkan halaman checkout untuk satu item "Beli Sekarang".
     */
    public function checkoutNow(Request $request)
    {
        $validated = $request->validate([
            'sku' => ['required', 'string', 'exists:products,sku'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $user = auth()->user();
        $product = Products::where('sku', $validated['sku'])->firstOrFail();

        $checkoutItem = new \stdClass();
        $checkoutItem->product = $product;
        $checkoutItem->qty = (int)$validated['qty'];

        $totalPrice = $product->price * $validated['qty'];


        return view('checkout', [
            'checkouts' => collect([$checkoutItem]),
            'payments' => Payment::all(),
            // 'shipments' => Shipment::all(), // Tidak lagi dibutuhkan
            'userAlamat' => $user->alamat,
            'checkout_type' => 'now',
            'sku' => $product->sku,
            'qty' => (int)$validated['qty'],
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Menampilkan halaman checkout untuk item yang dipilih dari keranjang.
     */
    public function checkoutSelected(Request $request)
    {
        $validated = $request->validate([
            'cart_selected' => ['required', 'array', 'min:1'],
            'cart_selected.*' => ['string', 'exists:products,sku'],
        ]);

        $user = auth()->user();
        $selectedSkus = $validated['cart_selected'];

        $checkouts = Carts::with('product')
            ->where('email', $user->email)
            ->whereIn('sku', $selectedSkus)
            ->get();

        if ($checkouts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak ditemukan.');
        }

        $totalPrice = $checkouts->sum(function($item) {
            return optional($item->product)->price * $item->qty;
        });


        return view('checkout', [
            'checkouts' => $checkouts,
            'payments' => Payment::all(),
            // 'shipments' => Shipment::all(), // Tidak lagi dibutuhkan
            'userAlamat' => $user->alamat,
            'checkout_type' => 'selected',
            'cart_selected' => $selectedSkus,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Memproses semua jenis checkout.
     */
    public function process(Request $request)
    {
        $user = auth()->user();

        // 1. Validasi input (tanpa shipping_method_code)
        $validated = $request->validate([
            'payment_method_code'  => ['required', 'string', 'exists:payment_status,code'],
            'checkout_type'        => ['required', 'string', 'in:cart,now,selected'],
            'sku'                  => ['required_if:checkout_type,now', 'string', 'exists:products,sku'],
            'qty'                  => ['required_if:checkout_type,now', 'integer', 'min:1'],
            'cart_selected'        => ['required_if:checkout_type,selected', 'array', 'min:1'],
            'cart_selected.*'      => ['string', 'exists:products,sku'],
        ]);

        // 2. Ambil data metode pembayaran
        $paymentMethod = Payment::where('code', $validated['payment_method_code'])->firstOrFail();

        // 3. Tentukan item mana yang akan diproses
        $itemsToProcess = collect();
        $checkoutType = $validated['checkout_type'];

        if ($checkoutType === 'now') {
            $product = Products::where('sku', $validated['sku'])->firstOrFail();
            $item = new \stdClass();
            $item->product = $product;
            $item->qty = (int)$validated['qty'];
            $itemsToProcess->push($item);
        } else {
            $query = Carts::with('product')->where('email', $user->email);
            if ($checkoutType === 'selected') {
                $query->whereIn('sku', $validated['cart_selected']);
            }
            $itemsToProcess = $query->get();
        }

        if ($itemsToProcess->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk diproses.');
        }

        // 4. Hitung total harga
        //    $shippingCost sekarang adalah ANGKA (0), bukan objek.
//        $productSubtotal = $itemsToProcess->sum(fn($item) => $item->product->price * $item->qty);
        //    Total dihitung langsung dengan variabel angka.
        // Hentikan eksekusi dan tampilkan hanya array harganya.


        // Kode di bawah ini tidak akan berjalan selama dd() aktif.
        $shippingCost = 0;
        $productSubtotal = $itemsToProcess->sum(fn($item) => optional($item->product)->price * $item->qty);
        $grandTotal = $productSubtotal + $shippingCost;


        $invoiceNumber = 'INV' . now()->format('YmdHis') . strtoupper(Str::random(4));

        // 5. Gunakan Database Transaction
        $transaction = null;
        DB::transaction(function () use (
            $user, $itemsToProcess, $paymentMethod, $grandTotal, $invoiceNumber, $checkoutType, &$transaction
        ) {
            // A. Buat record transaksi
            $transaction = Transactions::create([
                'email'             => $user->email,
                'invoice'           => $invoiceNumber,
                'name'              => $user->name,
                'total'             => $grandTotal,
                'metode_pembayaran' => $paymentMethod->name,
                'pengiriman'        => 'Akan Segera Diproses',
                'tanggal_pemesanan' => now(),
                'pembayaran'        => 'Belum Dibayar',
            ]);

            // B. Buat nomor invoice berdasarkan ID, lalu update
            $invoiceNumber = 'INV-' . str_pad($transaction->id + 10000, 5, '0', STR_PAD_LEFT);
            $transaction->invoice = $invoiceNumber;
            $transaction->save();

            // C. Buat record detail transaksi
            foreach ($itemsToProcess as $item) {
                TransactionsDetail::create([
                    'invoice' => $invoiceNumber,
                    'sku'     => $item->product->sku,
                    'qty'     => $item->qty,
                    'total'   => $item->product->price * $item->qty,
                ]);
            }

            // D. Hapus item dari keranjang jika perlu
            if ($checkoutType === 'cart') {
                Carts::where('email', $user->email)->delete();
            } elseif ($checkoutType === 'selected') {
                $skusToDelete = $itemsToProcess->pluck('product.sku');
                Carts::where('email', $user->email)->whereIn('sku', $skusToDelete)->delete();
            }
        });

        // 6. Redirect ke halaman detail transaksi
        return redirect()->route('order.success', $transaction->invoice)
            ->with('success', 'Pesanan dengan invoice ' . $transaction->invoice . ' berhasil dibuat!');
    }
}
