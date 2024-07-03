<div class="modal fade" id="editProductModal_{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel_{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel_{{ $product->id }}">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="name" value="{{ $product->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="price" value="{{ $product->price }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
