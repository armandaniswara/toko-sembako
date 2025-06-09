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


}
