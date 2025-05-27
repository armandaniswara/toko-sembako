{{--<tr>--}}
{{--    <td>{{ $transactions->firstItem() + $index }}</td>--}}
{{--    <td>{{ $transaction->tanggal_pemesanan->format('d M Y')  }}</td>--}}
{{--    <td>{{ $transaction->name }}</td>--}}
{{--    <td>{{ $transaction->invoice }}</td>--}}
{{--    <td>{{ $transaction->pengiriman }}</td>--}}
{{--    <td>{{ $transaction->pembayaran }}</td>--}}
{{--    <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>--}}
{{--    <td>--}}
{{--        <a href="#"--}}
{{--           class="btn btn-warning btn-sm"--}}
{{--           data-bs-toggle="modal"--}}
{{--           data-bs-target="#addProductModal"--}}
{{--           data-pengiriman="{{ $transaction->pengiriman }}"--}}
{{--           data-pembayaran="{{ $transaction->pembayaran }}"--}}
{{--        >--}}
{{--            Edit--}}
{{--        </a>--}}

{{--        <form action="{{ route('products.destroy', $transaction->id) }}" method="POST" class="d-inline">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>--}}
{{--        </form>--}}
{{--        <a  href="#"--}}
{{--            class="btn btn-success btn-sm">Detail</a>--}}
{{--    </td>--}}
{{--</tr>--}}
{{--    modal    --}}
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#" id="editTransactionForm" class="modal-content">
                    @csrf
                    @method('PUT')
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

