<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
{{--        <form method="POST" id="editProductForm" action="{{ route('products.update', $product->id) }}"--}}
{{--              enctype="multipart/form-data">--}}
            <form method="POST" id="editProductForm"  action="{{ route('products.update', $product->id) }}"
                  enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
{{--            <div class="modal-content">--}}
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id">

                    <div class="mb-3">
                        <label for="edit-sku" class="form-label">SKU</label>
                        <input type="text" class="form-control" id="edit-sku" name="sku" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="edit-price" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="edit-stock" name="stock" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                        <img id="edit-preview" src="" alt="Current Image" width="80" class="mt-2">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
{{--            </div>--}}
        </form>
    </div>
</div>
