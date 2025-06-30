@extends('layouts.app2') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Pesanan Berhasil')

@section('content')
    <body class="bg-light">
    <div class="container" style="margin-top: 15vh; margin-bottom: 5vh;">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                        <h2 class="fw-bold">Terima Kasih!</h2>
                        <p class="text-muted">Pesanan Anda telah kami terima dan akan segera diproses. Silakan lakukan pembayaran sebelum batas waktu yang ditentukan.</p>
                        <hr>
                        <h5 class="fw-bold mt-4">Detail Pesanan Anda</h5>
                        <p class="fs-5">Nomor Invoice: <strong class="text-primary">{{ $transaction->invoice }}</strong></p>
                        <p class="fs-5">Total Pembayaran: <strong class="text-danger">Rp{{ number_format($transaction->total, 0, ',', '.') }}</strong></p>

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali ke Beranda</a>
                            <a href="/pesanan" class="btn btn-primary">Lihat Riwayat Pesanan</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </body>
@endsection
