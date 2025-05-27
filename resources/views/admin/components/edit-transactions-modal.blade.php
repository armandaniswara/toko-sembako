{{--editTransactionModal--}}
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form id="editTransactionForm" method="POST" action="" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionModalLabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <input type="hidden" id="edit-id" name="id">

            <div class="modal-body">

                <div class="mb-3">
                    <label for="edit-pengiriman" class="form-label">Status Pengiriman</label>
                    <select name="pengiriman" id="edit-pengiriman" class="form-control my-1" required>
                        <option value="">-- Pilih Status Pengiriman --</option>
                        <option
                            value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>
                            Belum Dikirim
                        </option>
                        <option
                            value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>
                            Dalam Perjalanan
                        </option>
                        <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>
                            Terkirim
                        </option>
                        <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="edit-pembayaran" class="form-label">Status Pembayaran</label>
                    <select name="pembayaran" id="edit-pembayaran" class="form-control my-1" required>
                        <option value="">-- Pilih Status Pembayaran --</option>
                        <option
                            value="Belum Dibayar" {{ old('status_pembayaran') == 'Belum Dibayar' ? 'selected' : '' }}>
                            Belum Dibayar
                        </option>
                        <option value="Dibayar" {{ old('status_pembayaran') == 'Dibayar' ? 'selected' : '' }}>Dibayar
                        </option>
                        <option value="Gagal" {{ old('status_pembayaran') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Ubah</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </form>
    </div>
</div>
</div>

