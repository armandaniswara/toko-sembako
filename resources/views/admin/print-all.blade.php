
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Transaksi</title>
    <link href="[https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css](https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css)" rel="stylesheet">
    <style>
        body { font-family: 'sans-serif'; font-size: 12px; }
        .report-header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #dee2e6; padding: 8px; }
        .table th { background-color: #f8f9fa; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        @media print {
            .no-print { display: none !important; }
            @page { margin: 0.5cm; }
            body { margin: 0; }
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="report-header">
        <h3>Laporan Semua Transaksi Penjualan</h3>
        <h6>Dicetak pada: {{ now()->format('d F Y H:i') }}</h6>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th class="text-end">Total</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->invoice }}</td>
                <td>{{ $transaction->tanggal_pemesanan->format('d-m-Y H:i') }}</td>
                <td>{{ $transaction->name }}</td>
                <td class="text-end">Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data transaksi.</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" class="text-end fw-bold">Grand Total</td>
            <td class="text-end fw-bold">Rp{{ number_format($grandTotal, 0, ',', '.') }}</td>
        </tr>
        </tfoot>
    </table>
    <div class="d-flex justify-content-end mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success">
            <i class="fa fa-print me-2"></i> Print Laporan
        </button>
    </div>
</div>
<script type="text/javascript">
    window.print();
</script>
</body>
</html>
