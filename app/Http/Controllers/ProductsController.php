<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Products::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // agar parameter ?search= tetap ada saat pagination

        return view('admin.products', compact('products'));
    }

    public function shop(Request $request)
    {
        $search = $request->query('search');

        $products = Products::query()
            ->when($search, function ($query, $search) {
                // Pengguna hanya bisa mencari berdasarkan nama produk
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->latest() // Cara singkat untuk orderBy('created_at', 'desc')
            ->paginate(12) // Tampilkan 12 produk per halaman
            ->withQueryString(); // Agar ?search=... tetap ada di link pagination

        // Kirim juga variabel $search ke view agar bisa ditampilkan di input field
        return view('home', compact('products', 'search'));
    }


    public function detail($id)
    {
        $product = Products::where('id', $id)->firstOrFail();
        return view('product-detail', compact('product'));
    }


    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => ['required', 'string', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // max 2MB
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/products', $filename);
            $validated['image'] = $filename;
        }

        Products::create($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        // Validasi input
        $request->validate([
            'sku' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update data dasar
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;

        // Jika user upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && \Storage::exists('public/products/' . $product->image)) {
                \Storage::delete('public/products/' . $product->image);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/products', $filename);

            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
