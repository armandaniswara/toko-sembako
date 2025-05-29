@extends('admin.layouts.app')

@section('title', 'Detail')

@section('content')
    <div class="d-grid gap-5  mt-3" id="addProductModal">
        <h3 class="fw-bold mt-4">Data Master Transaction</h3>
        <div class="container bg-white d-grid gap-3 p-4" style="height: auto; width: 95%">
            @forelse($transactions as $item => $transaction)
                <div class="d-flex gap-4">
                    <div class="flex-fill bd-highlight gap-2">
                        <div class="">
                            <p class="fw-bold">Tanggal Pemesanan</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="{{ $transaction->tanggal_pemesanan }}" readonly>
                        </div>
                        <div class="">
                            <p class="fw-bold">Nama</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="{{ $transaction->name }}" readonly>
                        </div>
                        <div class="">
                            <p class="fw-bold">Status Pengiriman</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="{{ $transaction->pengiriman }}" readonly>
                        </div>
                    </div>
                    <div class="flex-fill bd-highlight gap-2">
                        <div class="">
                            <p class="fw-bold">Status Pembayaran</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="{{ $transaction->pembayaran }}" readonly>
                        </div>
                        <div class="">
                            <p class="fw-bold">Invoice</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="{{ $transaction->invoice }}" readonly>
                        </div>
                        <div class="">
                            <p class="fw-bold">Total</p>
                            <input type="text" class="form-control bg-light" id="qty"
                                   value="Rp{{ number_format($transaction->total, 2, ',', '.') }}" readonly>
                        </div>
                    </div>
                </div>
            @empty
                <p> not found </p>
            @endforelse
            <table class="table table-striped mt-4">
                <thead>
                <tr>
                    <th>Quantity</th>
                    <th>SKU</th>
                    <th>Nama</th>
                    <th>Harga Produk</th>
                </tr>
                </thead>
                <tbody>
                @forelse($details as $item => $detail)
                    <tr>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ $detail->sku }}</td>
                        @empty
                            <p> not found </p>
                        @endforelse
                        @forelse($products as $item => $product)
                            <td>{{ $product->name }}</td>
                            <td>RP{{ number_format($product->price, 2, ",", ".")  }}</td>
                        @empty
                            <p> not found </p>
                @endforelse
                </tbody>
            </table>
            <div class="d-flex gap-1">
                <button type="submit" class="btn btn-primary">Print</button>
                <button href="/transaction" type="submit" class="btn btn-secondary">Kembali</button>
            </div>
        </div>
    </div>
    {{--    @push('scripts')--}}
    {{--        <script>--}}
    {{--            const editModal = document.getElementById('editTransactionModal');--}}
    {{--            editModal.addEventListener('show.bs.modal', function (event) {--}}
    {{--                const button = event.relatedTarget;--}}

    {{--                const id = button.getAttribute('data-id');--}}
    {{--                const pengiriman = button.getAttribute('data-pengiriman');--}}
    {{--                const pembayaran = button.getAttribute('data-pembayaran');--}}

    {{--                // Isi input modal dengan data--}}
    {{--                editModal.querySelector('#edit-id').value = id;--}}
    {{--                editModal.querySelector('#edit-pengiriman').value = pengiriman;--}}
    {{--                editModal.querySelector('#edit-pembayaran').value = pembayaran;--}}

    {{--                const form = document.getElementById('editTransactionForm');--}}
    {{--                form.action = `/detail/${invoice}`;--}}
    {{--            });--}}
    {{--        </script>--}}
    {{--    @endpush--}}
@endsection
