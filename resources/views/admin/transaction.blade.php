@extends('admin.layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="container mt-5">
        <h1 class="mt-4">Transaksi</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('transaction.index') }}" class="mb-3">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search products..."
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary" type="submit">Search</button>

            </div>
        </form>

    </div>

{{--    modal    --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf


                        <select name="status_pengiriman" class="form-control my-1" required>
                            <option value="">-- Pilih Status Pengiriman --</option>
                            <option value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                            <option value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>

                        <select name="status_pembayaran" class="form-control my-1" required>
                            <option value="">-- Pilih Status Pembayaran --</option>
                            <option value="Belum Dibayar" {{ old('status_pembayaran') == 'Belum Dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                            <option value="Dibayar" {{ old('status_pembayaran') == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="Gagal" {{ old('status_pembayaran') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>

                        <button type="submit" class="btn btn-primary">Ubah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($transactions->count())
        <table class="table table-striped mt-4">
            <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pemesanan</th>
                <th>Invoice</th>
                <th>Status Pembayaran</th>
                <th>Status Pengiriman</th>
                <th>Pembayaran</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $index => $transaction)
                <tr>
                    <td>{{ $transactions->firstItem() + $index }}</td>
                    <td>{{ $transaction->tanggal_pemesanan->format('d M Y')  }}</td>
                    <td>{{ $transaction->invoice }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td>{{ $transaction->pengiriman }}</td>
                    <td>{{ $transaction->pembayaran }}</td>
                    <td>
                        <a href="#" data-bs-toggle="modal" type="button" data-bs-target="#addProductModal" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $transaction->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $transactions->links() }}
        </div>
    @else
        <div class="alert alert-info mt-4">
            Tidak ada produk ditemukan.
        </div>
    @endif
@endsection
