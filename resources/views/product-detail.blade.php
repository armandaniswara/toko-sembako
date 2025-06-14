@extends('layouts.app')

@section('title', 'Carts-Detail')

@section('content')
    <div class="d-flex p-5 my-5">
        <div class="" style="width: 33.3%">
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                     class="belanja-card-img" style="width: 67%">
            @else
                <span class="text-muted">No image</span>
            @endif
        </div>
        <div class="" style="width: 43.3%">
            <h1 class="w-100">{{ $product->name }}</h1>
            {{-- Menambahkan ID pada harga utama untuk referensi jika perlu --}}
            <h2 id="base-price" data-price="{{ $product->price }}">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </h2>
        </div>
        <div class="card p-3" style="width: 20%; height: 50vh;">
            <h6>Atur jumlah dan catatan</h6>
            <div class="d-flex align-items-center mb-1">
                <div class="border rounded d-flex align-items-center px-2" style="height: 7vh; width:110px">
                    <button class="btn btn-link text-muted px-2" onclick="kurangiQty()" style="text-decoration: none;">
                        −
                    </button>
                    {{-- ID 'qty' sudah benar --}}
                    <input type="text" id="qty" class="form-control border-0 text-center px-1" value="1" readonly
                           style="width:30px">
                    <button class="btn btn-link text-success px-2" onclick="tambahQty()" style="text-decoration: none;">
                        ＋
                    </button>
                </div>
                <p class="mt-2 ms-3">Stok: <strong id="stock-display">{{$product->stock}}</strong></p>
            </div>
            {{-- PERUBAHAN: Menambahkan ID 'subtotal' agar mudah dimanipulasi oleh JavaScript --}}
            <h6>Sub total: <span id="subtotal">Rp{{ number_format($product->price, 0, ',', '.') }}</span></h6>

            {{-- Form untuk tambah ke keranjang --}}
            <form id="add-to-cart-form" action="{{ route('carts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <input type="hidden" name="sku" value="{{ $product->sku }}">
                <input type="hidden" id="form-qty" name="qty" value="1">
                <button type="submit" class="my-2 btn ff-popins w-100" style="background-color: #b98a55; color: white;">
                    + Keranjang
                </button>
            </form>

            <button class="btn ff-popins w-100" style="background-color: white; color: #b98a55; border:2px solid #b98a55">Beli Sekarang</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // PERUBAHAN: Menyimpan data penting dari PHP ke variabel JavaScript
        // Ini cara terbaik untuk mendapatkan nilai mentah (raw value) tanpa format
        const basePrice = {{ $product->price }};
        const maxStock = {{ $product->stock }};

        // Mengambil elemen-elemen yang akan kita gunakan
        const qtyInput = document.getElementById('qty');
        const formQtyInput = document.getElementById('form-qty');
        const subtotalElement = document.getElementById('subtotal');

        // Fungsi baru untuk memperbarui subtotal
        function updateSubtotal() {
            // 1. Ambil nilai kuantitas saat ini
            const currentQty = parseInt(qtyInput.value);

            // 2. Hitung subtotal baru
            const newSubtotal = basePrice * currentQty;

            // 3. Format subtotal ke dalam format Rupiah dan tampilkan
            // Menggunakan Intl.NumberFormat adalah cara modern dan lebih baik
            subtotalElement.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(newSubtotal);
        }

        // PERUBAHAN: Memperbarui fungsi kurangiQty
        function kurangiQty() {
            let value = parseInt(qtyInput.value);
            if (value > 1) {
                qtyInput.value = value - 1;
                // Panggil fungsi update setelah mengubah nilai
                updateSubtotal();
            }
        }

        // PERUBAHAN: Memperbarui fungsi tambahQty
        function tambahQty() {
            let value = parseInt(qtyInput.value);
            // Tambahkan pengecekan agar tidak melebihi stok
            if (value < maxStock) {
                qtyInput.value = value + 1;
                // Panggil fungsi update setelah mengubah nilai
                updateSubtotal();
            }
        }

        // Pastikan saat submit form, qty hidden telah sinkron dengan nilai qtyInput
        document.getElementById('add-to-cart-form').addEventListener('submit', function () {
            formQtyInput.value = qtyInput.value;
        });
    </script>
@endpush
