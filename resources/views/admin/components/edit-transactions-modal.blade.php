<tr>
    <td>{{ $transactions->firstItem() + $index }}</td>
    <td>{{ $transaction->tanggal_pemesanan->format('d M Y')  }}</td>
    <td>{{ $transaction->invoice }}</td>
    <td>{{ $transaction->status }}</td>
    <td>{{ $transaction->pengiriman }}</td>
    <td>{{ $transaction->pembayaran }}</td>
    <td>
        <a href="#"
           class="btn btn-warning btn-sm"
           data-bs-toggle="modal"
           data-bs-target="#addProductModal"
           data-id="{{ $transaction->id }}"
           data-status="{{ $transaction->status }}"
           data-pengiriman="{{ $transaction->pengiriman }}"
           data-pembayaran="{{ $transaction->pembayaran }}"
        >
            Edit
        </a>

        <form action="{{ route('products.destroy', $transaction->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</button>
        </form>
    </td>
</tr>
