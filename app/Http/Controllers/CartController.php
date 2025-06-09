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
        $carts = Cart::with('product')->get();

        return view('checkout', compact('carts'));
    }


}
