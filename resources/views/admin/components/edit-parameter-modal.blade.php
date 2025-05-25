<div class="modal fade" id="editParameterModal" tabindex="-1" aria-labelledby="editParameterModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <form id="editParameterForm" method="POST" action="" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Parameter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <input type="hidden" id="edit-id" name="id">

            <div class="modal-body">
                <input type="hidden" name="type" value="{{ $type }}">

                <div class="mb-3">
                    <label for="edit-code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="edit-code" name="code" required>
                </div>

                <div class="mb-3">
                    <label for="edit-name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Parameter</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
