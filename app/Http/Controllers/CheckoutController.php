<?php  


public function index()
{
    $items = [
        ['nama' => 'Beras 5kg', 'qty' => 2, 'harga' => 60000],
        ['nama' => 'Minyak Goreng 1L', 'qty' => 3, 'harga' => 15000],
    ];

    $total = collect($items)->sum(function ($item) {
        return $item['harga'] * $item['qty'];
    });

    return view('checkout', compact('items', 'total'));
}

public function store(Request $request)
{
    // Validasi dan simpan data checkout
    return redirect()->route('home')->with('success', 'Pesanan berhasil diproses!');
}
