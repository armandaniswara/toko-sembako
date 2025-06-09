<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::all();
        return view('checkout', compact('cart'));
    }


    public function detail()
    {
        $cart = Cart::with(['product', 'cart'])
            ->get();

        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Data transaction_detail tidak ditemukan untuk invoice: ');
        }

        return view('checkout', compact('cart'));
    }


}
