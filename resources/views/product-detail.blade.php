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
                <p class="">Stock: {{$product->stock}}</p>
                <h2>Rp{{ number_format($product->price, 0, ' ,', '.') }}</h2>

            </div>
            <div class="card p-3 " style="width: 20%; height: 50vh;">
                <h6>Atur jumlah dan catatan</h6>
                <div class="d-flex align-items-center mb-1">
                <div class="border rounded d-flex align-items-center px-2" style="height: 7vh; width:110px">
                    <button class="btn btn-link text-muted px-2" onclick="kurangiQty()" style="text-decoration: none;">
                        −
                    </button>
                    <input type="text" id="qty" class="form-control border-0 text-center px-1" value="1" readonly
                           style="width:30px">
                    <button class="btn btn-link text-success px-2" onclick="tambahQty()" style="text-decoration: none;">
                        ＋
                    </button>

                </div>
                <p class="mt-2 ms-3">Stok: <strong>{{$product->stock}}</strong></p>
                </div>
                <h6>Sub total: RP{{ number_format($product->price, 0, ' ,', '.') }} </h6>
                <button class=""></button>
                <button class="my-2 btn ff-popins w-100" style="background-color: #b98a55; color: white; ">Checkout</button>
                <button class=" btn ff-popins w-100 " style=" background-color: white; color: #b98a55; border:2px solid #b98a55 ">Beli Sekarang</button>
            </div>
    </div>
    @push('scripts')
    <script>
    function kurangiQty() {
        const qty = document.getElementById('qty');
        let value = parseInt(qty.value);
        if (value > 1) qty.value = value - 1;
    }

    function tambahQty() {
        const qty = document.getElementById('qty');
        let value = parseInt(qty.value);
        qty.value = value + 1;
    }
    </script>
    @endpush

@endsection
