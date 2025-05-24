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
                    <form method="POST" action="#" id="editTransactionForm">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="edit-id">
                        <p>Status Pengiriman</p>

                        <select name="pengiriman" id="edit-pengiriman" class="form-control my-1" required>
                            <option value="">-- Pilih Status Pengiriman --</option>
                            <option value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>Belum Dikirim</option>
                            <option value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>Terkirim</option>
                            <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>

                        <p>Status Pembayaran</p>

                        <select name="pembayaran" id="edit-pembayaran" class="form-control my-1" required>
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
                @include('admin.components.edit-transactions-modal', ['transaction' => $transaction])
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
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const editModal = document.getElementById('addProductModal');
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');
                    const pengiriman = button.getAttribute('data-pengiriman');
                    const pembayaran = button.getAttribute('data-pembayaran');

                    const form = document.getElementById('editTransactionForm');
                    form.action = `/admin/transactions/${id}`;

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-pengiriman').value = pengiriman;
                    document.getElementById('edit-pembayaran').value = pembayaran;
                });
            });
        </script>
    @endpush
@endsection
