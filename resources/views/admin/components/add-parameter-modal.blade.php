<div class="modal fade" id="addParameterModal" tabindex="-1" aria-labelledby="addParameterModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Parameter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="addParameterForm" action="{{ route('parameter.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="{{ $type }}">

                    <div class="mb-3">
                        <label for="sku" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" name="code" required
                               value="{{ old('code') }}">
                        @error('code')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required
                               value="{{ old('name') }}">
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Parameter</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
