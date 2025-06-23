<?php

namespace App\http\View\Composers;

use Illuminate\View\View;
use App\Models\Carts; // Pastikan model Carts Anda di-import
use Illuminate\Support\Facades\Auth;

class CartComposer
{
    public function compose(View $view)
    {
        // Periksa apakah ada pengguna yang sedang login
        if (Auth::check()) {
            // Ambil email dari pengguna yang login
            $userEmail = Auth::user()->email;

            // Hitung jumlah item di keranjang berdasarkan email
            $cartCount = Carts::where('email', $userEmail)->count();
        } else {
            // Jika tidak ada yang login, jumlahnya 0
            $cartCount = 0;
        }

        // Kirim variabel $cartCount ke view
        $view->with('cartCount', $cartCount);
    }
}
