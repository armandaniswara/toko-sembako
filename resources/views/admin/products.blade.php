@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="container mt-5">
        <h1 class="mt-4">Add New Product</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('products.index') }}" class="mb-3">
            <div class="input-group">
                <button
                    type="button"
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#addProductModal"
                >
                    Add Product
                </button>
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search products..."
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary" type="submit">Search</button>

            </div>
        </form>

        {{--    @if($products->count())--}}
        <table class="table table-striped mt-4">
            <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">SKU</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $index => $product)
                <tr>
                    <td>{{ $products->firstItem() + $index }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="Product Image"
                                 width="80">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->name }}</td>
                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        {{--                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>--}}
                        <button type="button"
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editProductModal"
                                data-id="{{ $product->id }}"
                                data-sku="{{ $product->sku }}"
                                data-name="{{ $product->name }}"
                                data-price="{{ $product->price }}"
                                data-stock="{{ $product->stock }}"
                                data-image="{{ asset('storage/products/' . $product->image) }}">
                            Edit
                        </button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $products->withQueryString()->links() }}
        </div>

        <!-- Add Product Modal -->
        @include('admin.components.add-product-modal')

        <!-- Edit Product Modal -->
{{--        @include('admin.components.edit-product-modal')--}}

    @foreach ($products as $product)
        @include('admin.components.edit-product-modal', ['product' => $product])
    @endforeach

        @push('scripts')
            <script>
                setTimeout(function () {
                    const alertSuccess = document.querySelector('.alert-success');
                    if (alertSuccess) {
                        alertSuccess.style.transition = 'opacity 0.5s ease';
                        alertSuccess.style.opacity = '0';
                        setTimeout(() => alertSuccess.remove(), 500); // Hapus setelah fade out
                    }
                }, 3000); // 3000ms = 3 detik

                const editModal = document.getElementById('editProductModal');
                editModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const sku = button.getAttribute('data-sku');
                    const name = button.getAttribute('data-name');
                    const price = button.getAttribute('data-price');
                    const stock = button.getAttribute('data-stock');
                    const image = button.getAttribute('data-image');

                    // Isi input modal dengan data
                    editModal.querySelector('#edit-id').value = id;
                    editModal.querySelector('#edit-sku').value = sku;
                    editModal.querySelector('#edit-name').value = name;
                    editModal.querySelector('#edit-price').value = price;
                    editModal.querySelector('#edit-stock').value = stock;
                    if (image) {
                        editModal.querySelector('#edit-preview').src = image;
                        editModal.querySelector('#edit-preview').style.display = 'block';
                    } else {
                        editModal.querySelector('#edit-preview').style.display = 'none';
                    }

                    // Set form action URL
                    const form = document.getElementById('editProductForm');
                    form.action = `/admin/products/${id}`;
                });
            </script>
    @endpush
@endsection
