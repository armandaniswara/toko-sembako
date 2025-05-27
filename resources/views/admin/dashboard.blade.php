@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-3">
        <h1 class="mt-4 pb-2">Dashboard</h1>

        {{-- Stat cards --}}

        <div class="d-flex mb-4">
            <div class="bg-white rounded-3 shadow flex-fill me-3" style="height: 150px;">
                <p class="fw-bold py-3 px-3 fs-5">Pelanggan</p>
                <p class="fw-bold fs-5 px-3 text-success">{{$totalUniqueCustomers}}</p>
{{--                <div id="sparklinedash">--}}
{{--                    <canvas width="67" height="30" style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>--}}
{{--                </div>--}}
            </div>
            <div class="bg-white rounded-3 shadow flex-fill me-3" style="height: 150px;">
                <p class="fw-bold py-3 px-3 fs-5">Transaksi</p>
                <p class="fw-bold fs-5 px-3 text-warning">{{$totalTransactions}}</p>
            </div>
            <div class="bg-white rounded-3 shadow flex-fill" style="height: 150px;">
                <p class="fw-bold py-3 px-3 fs-5">Pendapatan</p>
                <p class="fw-bold fs-5 px-3 text-info ">IDR {{ number_format($totalRevenue,0,',','.') }}</p>

            </div>
        </div>

        {{-- Tabel Transaksi Terbaru --}}
        <div>
            <div class="fw-bold mb-2">
                Daftar Transaksi Terbaru
            </div>
            <div class="card-body p-0">
                @if($transactions->count())
                    <table class="table mb-0">
                        <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Invoice</th>
                            <th>Status Bayar</th>
                            <th>Status Kirim</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $index => $transaction)
                            <tr>
                                <td>{{ $transactions->firstItem() + $index }}</td>
                                <td>{{ $transaction->tanggal_pemesanan->format('d M Y') }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->invoice }}</td>
                                <td>{{ $transaction->pembayaran }}</td>
                                <td>{{ $transaction->pengiriman }}</td>
                                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center my-3">
        {{ $transactions->links() }}
    </div>
    @else
        <div class="alert alert-info mt-4">
            Tidak ada produk ditemukan.
        </div>
    @endif
@endsection
