@extends('admin.layouts.app')

@section('title', 'Detail')

@section('content')
    <div class="d-grid gap-5  mt-3" id="addProductModal">
        <p class="fs-5 fw-bold mt-4">Data Master Transaction</p>
        <div class="container bg-white d-flex align-items-center" style="height: 100px; width: 95%">
            <i class="bi bi-arrow-left-short fs-5"></i>
            <a href="/admin" type="button" class="btn btn-outline-info btn-lg">Kembali</a>
        </div>
        <div class="container bg-white d-grid gap-3" style="height: auto; width: 95%">
            <div class="">
                <p class="fw-bold">Invoice</p>
                <input type="text" class="form-control bg-light" id="invoice" readonly>
            </div>
            <div class="">
                <p class="fw-bold">Nama</p>
                <input type="text" class="form-control bg-light" id="name" readonly>
            </div>
            <div class="">
                <p class="fw-bold">Total</p>
                <input type="text" class="form-control bg-light" id="total" readonly>
            </div>
            <form method="POST" action="#" id="editTransactionForm">
                <div class=""></div>
                @csrf
                @method('PUT')
                <p class="fw-bold">Status Pengiriman</p>
                <select name="pengiriman" id="edit-pengiriman" class="form-control my-1" required>
                    <option value="">-- Pilih Status Pengiriman --</option>
                    <option value="Belum Dikirim" {{ old('status_pengiriman') == 'Belum Dikirim' ? 'selected' : '' }}>
                        Belum Dikirim
                    </option>
                    <option
                        value="Dalam Perjalanan" {{ old('status_pengiriman') == 'Dalam Perjalanan' ? 'selected' : '' }}>
                        Dalam Perjalanan
                    </option>
                    <option value="Terkirim" {{ old('status_pengiriman') == 'Terkirim' ? 'selected' : '' }}>Terkirim
                    </option>
                    <option value="Dibatalkan" {{ old('status_pengiriman') == 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>
                </select>
                <p>Klik Tombol Ubah Untuk Menyimpan Perubahan Status Pengiriman</p>
            </form>
            <div class="">
                <p class="fw-bold">Status Pembayaran</p>
                <select name="pembayaran" id="edit-pembayaran" class="form-control my-1" required>
                    <option value="">-- Pilih Status Pembayaran --</option>
                    <option value="Belum Dibayar" {{ old('status_pembayaran') == 'Belum Dibayar' ? 'selected' : '' }}>
                        Belum Dibayar
                    </option>
                    <option value="Dibayar" {{ old('status_pembayaran') == 'Dibayar' ? 'selected' : '' }}>Dibayar
                    </option>
                    <option value="Gagal" {{ old('status_pembayaran') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
                <p>Klik Tombol Ubah Untuk Menyimpan Perubahan Status pembayaran</p>
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
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
                form.action = `/detail/${id}`;
            });

    @endpush
@endsection
