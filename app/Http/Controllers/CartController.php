<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Carts::all();
        return view('checkout', compact('cart'));
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


        Carts::create($validated);

        return back()->with('success', 'Product berhasil ditambahkan.');
    }


}
