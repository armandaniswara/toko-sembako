@extends('layouts.app2')

@section('title', 'Checkout')

@section('content')

    <body class="ps-5 pe-5" style="margin-top: 15vh;">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        {{-- Input tersembunyi yang penting --}}
        <input type="hidden" name="checkout_type" value="{{ $checkout_type }}">

        @if($checkout_type === 'now' && !$checkouts->isEmpty())
            <input type="hidden" name="sku" value="{{ $checkouts->first()->product->sku }}">
            <input type="hidden" name="qty" value="{{ $checkouts->first()->qty }}">
        @endif

        @if($checkout_type === 'selected' && isset($cart_selected))
            @foreach($cart_selected as $sku)
                <input type="hidden" name="cart_selected[]" value="{{ $sku }}">
            @endforeach
        @endif


        <div class="ps-5 pe-5">
            <h3 class="ps-3 ff-popins fw-bolder">Checkout</h3>
            <div class="d-flex p-3">
                <div class="container ff-popins" style="width: 68%;">
                    <div class=" bg-white rounded-3 p-3 my-3">
                        <h6 class="fw-bolder">Alamat Pengiriman</h6>
                        <div class="d-flex">
                            <i class="fa-solid fa-location-dot my-1 me-2"></i>
                            <p>{{ $userAlamat ?? 'Alamat tidak ditemukan' }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-3 p-3">
                        <h6 class="fw-bolder">Produk</h6>
                        <table class="table align-middle">
                            <tbody>
                            @forelse ($checkouts as $checkout)
                                <tr>
                                    <td style="width: 15%;">
                                        @if($checkout->product->image)
                                            <img style="width: 75px; height: auto;"
                                                 src="{{ asset('storage/products/' . $checkout->product->image) }}"
                                                 alt="{{ $checkout->product->name }}">
                                        @else
                                            <img style="width: 75px; height: auto;" src="[https://placehold.co/75x75/EFEFEF/A9A9A9?text=No+Image](https://placehold.co/75x75/EFEFEF/A9A9A9?text=No+Image)" alt="No image">
                                        @endif
                                    </td>
                                    <td style="width: 40%;">{{ $checkout->product->name }}</td>
                                    <td style="width: 15%;" class="fw-bold ff-popins">
                                        Rp{{ number_format($checkout->product->price , 0, ',', '.') }}</td>
                                    <td style="width: 27%;">
                                        <div class="input-group input-group-sm ms-5" style="width: 90px">
                                            <p>{{ $checkout->qty }} barang</p>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary py-3">Tidak ada item untuk di-checkout.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container bg-white rounded-3 ff-popins p-3 my-3" style="width: 30%;">
                    <h6 class="fw-bold">Metode Pembayaran</h6>
                    <div class="mb-3">
                        <select name="payment_method_code" id="payment-method" class="form-control my-1" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            @foreach($payments as $payment)
                                <option value="{{ $payment->code }}">{{ $payment->name }}</option>
                            @endforeach
                        </select>
                        @error('payment_method_code')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-secondary">Total</p>
                        {{-- Variabel $totalPrice sekarang datang langsung dari controller --}}
                        <p id="total-harga" class="fw-bold">Rp{{ number_format($totalPrice, 0, ',', '.') }}</p>
                    </div>
                    <div class="d-grid">
                        <button class="btn-custom fw-bold ff-popins rounded-3" type="submit"
                                style="height: 5vh; width: 100%;">Bayar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </body>

@endsection
