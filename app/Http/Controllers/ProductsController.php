<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Products::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('sku', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('products', compact('products', 'search'));
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => ['required', 'string', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ]);

        Products::create($validated);

        return redirect()->route('products')->with('success', 'Product berhasil ditambahkan.');
    }
}
