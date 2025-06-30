
@extends('layouts.app2') {{-- Sesuaikan dengan layout utama Anda --}}

@section('title', 'Instruksi Pembayaran')

@section('content')
    <body class="bg-light">
    <div class="container" style="margin-top: 15vh; margin-bottom: 5vh;">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0 fw-bold">Instruksi Pembayaran</h4>
                    </div>
                    <div class="card-body p-4 p-md-5 text-center">
                        <i class="fas fa-money-check-alt text-primary fa-3x mb-3"></i>

                        <p class="text-muted">Silakan lakukan pembayaran untuk pesanan dengan nomor invoice di bawah ini.</p>

                        {{-- Bagian Total Pembayaran --}}
                        <div class="alert alert-info mt-4">
                            <p class="mb-1 fs-5">Total yang harus dibayar:</p>
                            <p class="fw-bold display-6 text-danger mb-0">
                                Rp{{ number_format($transaction->total, 0, ',', '.') }}
                            </p>
                            <hr>
                            <p class="mb-0">
                                <strong>Invoice:</strong> {{ $transaction->invoice }}
                            </p>
                        </div>

                        <h5 class="fw-bold mt-4">Transfer ke salah satu rekening berikut:</h5>

                        {{-- Daftar Rekening Admin --}}
                        <ul class="list-group list-group-flush mt-3">
                            @forelse($adminBankAccounts as $bank => $account)
                                <li class="list-group-item">
                                    <strong class="fs-5">{{ $bank }}</strong>
                                    <p class="fs-4 mb-0 font-monospace">{{ $account }}</p>
                                </li>
                            @empty
                                <li class="list-group-item text-muted">
                                    Informasi rekening tidak tersedia. Silakan hubungi admin.
                                </li>
                            @endforelse
                        </ul>

                        <p class="mt-4 text-muted small">
                            Setelah melakukan pembayaran, mohon konfirmasi melalui WhatsApp atau email agar pesanan Anda dapat segera kami proses.
                        </p>

                        <div class="mt-4">
                            <a href="{{ route('order.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat Pesanan
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </body>
@endsection
