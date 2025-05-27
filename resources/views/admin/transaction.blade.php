@extends('admin.layouts.app')

@section('title', 'Transactions')

@section('content')
    <div class="container mt-3">
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

    <table class="table table-striped mt-4">
        <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pemesanan</th>
            <th>Nama</th>
            <th>Invoice</th>
            <th>Status Pengiriman</th>
            <th>Status Pembayaran</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($transactions as $index => $transaction)
            <tr>
                <td>{{ $transactions->firstItem() + $index }}</td>
                <td>{{ $transaction->tanggal_pemesanan->format('d M Y')  }}</td>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->invoice }}</td>
{{--                <td>{{ $transaction->pengiriman }}</td>--}}
                <td>
                    @php
                        $statusPengiriman = $transaction->pengiriman;
                        $warnaPengiriman = match($statusPengiriman) {
                            'Terkirim' => 'bg-success',
                            'Dalam Perjalanan' => 'bg-info',
                            'Belum Dikirim' => 'bg-warning',
                            'Dibatalkan' => 'bg-danger',
                            default => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $warnaPengiriman }}" style="font-size: 15px;">{{ $statusPengiriman }}</span>
                </td>
{{--                <td>{{ $transaction->pembayaran }}</td>--}}
                <td>
                    @php
                        $statusPembayaran = $transaction->pembayaran;
                        $warnaPembayaran = match($statusPembayaran) {
                            'Dibayar' => 'bg-light text-dark',
                            'Belum Dibayar' => 'bg-secondary',
                            'Gagal' => 'bg-dark',
                            default => 'bg-dark',
                        };
                    @endphp
                    <span class="badge {{ $warnaPembayaran }}" style="font-size: 15px;">{{ $statusPembayaran }}</span>
                </td>
                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                <td>
                    <a href="#"
                       class="btn btn-warning btn-sm"
                       data-bs-toggle="modal"
                       data-bs-target="#editTransactionModal"
                       data-id="{{ $transaction->id }}"
                       data-pengiriman="{{ $transaction->pengiriman }}"
                       data-pembayaran="{{ $transaction->pembayaran }}"
                    >
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $transaction->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete
                        </button>
                    </form>
                    <a href="#"
                       class="btn btn-success btn-sm">Detail</a>
                </td>
            </tr>
        @empty
            <div class="alert alert-info mt-4">
                Tidak ada produk ditemukan.
            </div>
        @endforelse
        </tbody>
    </table>

    <!-- Edit Product Modal -->
    @foreach($transactions as $index => $transaction)
        @include('admin.components.edit-transactions-modal', ['transaction' => $transaction])
    @endforeach
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $transactions->links() }}
    </div>



    @push('scripts')
        <script>
            const editModal = document.getElementById('editTransactionModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const pengiriman = button.getAttribute('data-pengiriman');
                    const pembayaran = button.getAttribute('data-pembayaran');

                    // Isi input modal dengan data
                    editModal.querySelector('#edit-id').value = id;
                    editModal.querySelector('#edit-pengiriman').value = pengiriman;
                    editModal.querySelector('#edit-pembayaran').value = pembayaran;

                    const form = document.getElementById('editTransactionForm');
                    form.action = `/transaction/${id}`;
                });
        </script>
    @endpush
@endsection
