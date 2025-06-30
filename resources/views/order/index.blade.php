
@extends('layouts.app2')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
    <body class="ps-5 pe-5" style="margin-top: 15vh; margin-bottom: 5vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{-- Notifikasi untuk pembayaran yang tertunda --}}
                @php
                    // Logika ini tetap ada karena kita masih menampilkan semua pesanan di tabel bawah
                    $pendingPayments = $orders->where('pembayaran', 'Belum Dibayar');
                @endphp

                @if($pendingPayments->isNotEmpty())
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Anda memiliki <strong>{{ $pendingPayments->count() }}</strong> pesanan yang menunggu pembayaran. Silakan selesaikan pembayaran untuk melanjutkan proses.
                    </div>
                @endif


                {{-- =================================================================== --}}
                {{-- PERUBAHAN: Tabel "Menunggu Pengiriman" telah dihapus dari sini --}}
                {{-- =================================================================== --}}


                {{-- Tabel untuk Semua Riwayat Transaksi --}}
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h4 class="mb-0 fw-bold">Semua Riwayat Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                <tr>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Status Pembayaran</th>
                                    <th class="text-center">Status Pengiriman</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="fw-bold">{{ $order->invoice }}</td>
                                        <td>{{ $order->tanggal_pemesanan->format('d M Y') }}</td>
                                        <td class="text-end">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @php
                                                $warnaPembayaran = match($order->pembayaran) {
                                                    'Dibayar' => 'bg-success',
                                                    'Gagal' => 'bg-danger',
                                                    default => 'bg-warning text-dark',
                                                };
                                            @endphp
                                            <span class="badge {{ $warnaPembayaran }}">{{ $order->pembayaran }}</span>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $statusPengiriman = $order->pengiriman;
                                                $warnaPengiriman = match($statusPengiriman) {
                                                    'Terkirim' => 'bg-success',
                                                    'Dalam Perjalanan' => 'bg-info text-dark',
                                                    'Belum Dikirim' => 'bg-warning text-dark',
                                                    'Dibatalkan' => 'bg-danger',
                                                    default => 'bg-dark',
                                                };
                                            @endphp
                                            <span class="badge {{ $warnaPengiriman }}">{{ $statusPengiriman }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($order->pembayaran == 'Belum Dibayar' && $order->pengiriman != 'Akan Segera Diproses')
                                                <a href="{{ route('order.payment', $order->invoice) }}" class="btn btn-sm btn-success mb-1">Bayar Sekarang</a>
                                            @endif
                                            <a href="{{ route('order.show', $order->invoice) }}" class="btn btn-sm btn-dark mb-1">Lihat Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-secondary py-4">
                                            Anda belum memiliki riwayat pesanan.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($orders->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
