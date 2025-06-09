@extends('admin.layouts.app')

@section('title', 'Detail')

@section('content')
    <div class="d-grid gap-5  mt-3" id="addProductModal">
        <h3 class="fw-bold mt-4">Data Master Transaction</h3>

        {{-- Pastikan $transactions tidak kosong dulu --}}
{{--        @if ($transactions->isNotEmpty())--}}
            <div class="d-flex gap-4">
                <div class="flex-fill bd-highlight">
                    <div class="mb-4">
                        <p class="fw-bold mb-0">Tanggal Pemesanan</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="{{ $transactions->first()->transaction->tanggal_pemesanan->format('d M Y') }}"
                               readonly>
                    </div>
                    <div class="mb-4">
                        <p class="fw-bold mb-0">Nama</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="{{ $transactions->first()->transaction->name }}" readonly>
                    </div>
                    <div class="mb-2">
                        <p class="fw-bold mb-0">Status Pengiriman</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="{{ $transactions->first()->transaction->pengiriman }}" readonly>
                    </div>
                </div>
                <div class="flex-fill bd-highlight">
                    <div class="mb-4">
                        <p class="fw-bold mb-0">Status Pembayaran</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="{{ $transactions->first()->transaction->pembayaran }}" readonly>
                    </div>
                    <div class="mb-4">
                        <p class="fw-bold mb-0">Invoice</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="{{ $transactions->first()->transaction->invoice }}" readonly>
                    </div>
                    <div class="mb-4">
                        <p class="fw-bold mb-0">Total</p>
                        <input type="text" class="form-control bg-light" id="qty"
                               value="Rp{{ number_format($totalSummary, 2) }}" readonly>
                    </div>
                </div>
            </div>
{{--        @endif--}}


        <div class="container bg-white d-grid gap-3 p-4" style="height: auto; width: 95%">

            <table class="table table-striped mt-4">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>QTY</th>
                    <th>Jumlah</th>
                </tr>
                </thead>
                    <tbody>
                    @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->sku }}</td>
                        <td>{{ $transaction->product->name }}</td>
                        <td>Rp{{ number_format($transaction->product->price, 2) }}</td>
                        <td>{{ $transaction->qty }}</td>
                        <td>Rp{{ number_format($transaction->jumlah, 2) }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                    </tbody>
{{--                    <tfoot>--}}
{{--                    <tr>--}}
{{--                        <td colspan="3"></td>--}}
{{--                        <td class="text-end fw-bold">Total:</td>--}}
{{--                        <td class="text-start">Rp100,000.00</td>--}}
{{--                    </tr>--}}

{{--                    </tfoot>--}}
            </table>


            <div class="d-flex gap-1">
                <button type="submit" class="btn btn-primary">Print</button>
                <button href="/transaction" type="submit" class="btn btn-secondary">Kembali</button>
            </div>
        </div>
    </div>
@endsection
