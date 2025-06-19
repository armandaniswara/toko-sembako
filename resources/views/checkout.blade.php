@extends('layouts.app2')

@section('title', 'Carts-Detail')

@section('content')
    <body class="ps-5 pe-5" style="margin-top: 15vh;">
    <div class="ps-5 pe-5">
    <h3 class="ps-3 ff-popins fw-bolder">Checkout</h3>
    <div class="d-flex p-3">
        <div class="container ff-popins" style="width: 68%;">
            <div class=" bg-white rounded-3 p-3 my-3">
                <h6 class="fw-bolder">Alamat Pengiriman</h6>
                <div class="d-flex">
                <i class="fa-solid fa-location-dot my-1 me-2"></i>
                <p>{{$userAlamat}}</p>
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
                                    <img style="width: 75px; height: auto;" src="{{ asset('storage/products/' . $checkout->product->image) }}" alt="{{ $checkout->product->name }}">
                                @else
                                    <img style="width: 75px; height: auto;" src="" alt="No image">
                                @endif
                            </td>
                            <td style="width: 40%;">{{ $checkout->product->name }}</td>
                            <td style="width: 15%;" class="fw-bold ff-popins">Rp{{ number_format($checkout->product->price , 2, ',', '.') }}</td>
                            <td style="width: 27%;">
                                <div class="input-group input-group-sm ms-5" style="width: 90px">
                                    <p>{{$checkout->qty}}</p>
                                </div>
                            </td>
                        </tr>
                        {{--                        <select name="type" class="form-select" onchange="this.form.submit()">--}}
{{--                            <option value="payment" {{ $type == 'payment' ? 'selected' : '' }}>Payment</option>--}}
{{--                            <option value="shipment" {{ $type == 'shipment' ? 'selected' : '' }}>Shipment</option>--}}
{{--                        </select>--}}
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary">keranjang kosong</td>
                        </tr>
                    @endforelse
                    <tr class="item-footer-row">
                        {{-- Gunakan colspan="4" agar sel ini memenuhi 4 kolom --}}
                        <td colspan="4" class="text-end pe-4">
                            @php
                                $subtotal = $checkout->product->price * $checkout->qty;
                            @endphp
                            <div class="mb-3">
                                <select name="pengiriman" id="edit-pengiriman" class="form-control my-1" required>
                                    <option value="">Pilih Metode Pengiriman</option>
                                    <option
                                        value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>
                                        Belum Dikirim
                                    </option>
                                    <option
                                        value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>
                                        Dalam Perjalanan
                                    </option>
                                    <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>
                                        Terkirim
                                    </option>
                                    <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>
                                        Dibatalkan
                                    </option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-white rounded-3 ff-popins p-3 my-3" style="width: 30%;">
            <h6 class="fw-bold" >Metode Pembayaran</h6>
            <div class="mb-3">
                <select name="pengiriman" id="edit-pengiriman" class="form-control my-1" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option
                        value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>
                        Belum Dikirim
                    </option>
                    <option
                        value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>
                        Dalam Perjalanan
                    </option>
                    <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>
                        Terkirim
                    </option>
                    <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>
                </select>
            </div>
            <div class="d-flex">
                <p class="text-secondary" style="width: 36vh">Total</p>
                <p id="total-harga" class="fw-bold">Rp 0</p>
            </div>
            <div class="d-grid">
                {{-- HAPUS FORM LAMA DI SINI --}}
                {{-- TOMBOL BELI SEKARANG MENJADI SUBMIT UNTUK FORM BESAR --}}
                <button class="btn-custom fw-bold ff-popins rounded-3" type="submit" style="height: 5vh; width: 50vh">Bayar</button>
            </div>
        </div>
    </div>
    </div>
    </body>


@endsection
