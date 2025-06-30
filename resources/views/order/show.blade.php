
@extends('layouts.app2')

@section('title', 'Detail Pesanan ' . $transaction->invoice)

@section('content')
    <body class="ps-5 pe-5" style="margin-top: 15vh; margin-bottom: 5vh;">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Detail Pesanan</h4>
                <a href="{{ route('order.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Riwayat
                </a>
            </div>
            <div class="card-body p-4">
                {{-- Informasi Utama --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Invoice:</strong><br>{{ $transaction->invoice }}</p>
                        <p class="mb-0"><strong>Tanggal Pesanan:</strong><br>{{ $transaction->tanggal_pemesanan->format('d F Y, H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Status Pembayaran:</strong><br><span class="badge bg-primary fs-6">{{ $transaction->pembayaran }}</span></p>
                        <p class="mb-0"><strong>Status Pengiriman:</strong><br><span class="badge bg-success fs-6">{{ $transaction->pengiriman }}</span></p>
                    </div>
                </div>

                {{-- Rincian Produk --}}
                <h5 class="fw-bold mt-4">Rincian Produk</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($transaction->details as $detail)
                            <tr>
                                <td>{{ $detail->product->name ?? 'Produk tidak ditemukan' }}</td>
                                <td class="text-center">{{ $detail->qty }}</td>
                                <td class="text-end">Rp{{ number_format($detail->product->price ?? 0, 0, ',', '.') }}</td>
                                <td class="text-end">Rp{{ number_format($detail->qty * ($detail->product->price ?? 0), 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Detail produk tidak ditemukan.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Rincian Biaya --}}
                <div class="row mt-3 justify-content-end">
                    <div class="col-md-5 col-lg-4">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal Produk:</span>
                                <span>Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Ongkos Kirim:</span>
                                <span>Rp{{ number_format($transaction->cost, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between fw-bold fs-5 bg-light">
                                <span>Grand Total:</span>
                                <span>Rp{{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
