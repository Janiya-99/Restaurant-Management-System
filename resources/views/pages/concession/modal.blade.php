<div id="concessionCreateModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Create Concession</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="submitForm" method="POST" action="{{ route('concessions.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label" for="name">Name <span>*</span></label>
                                <input type="text" class="form-control" id="name" placeholder="Name"
                                    name="name">
                            </div>

                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea type="text" class="form-control" id="description" placeholder="Description" name="description"></textarea>
                            </div>

                            <div class="mb-3 col-md-12 form-group">
                                <label for="image" class="form-label">Image <span>*</span></label>
                                <input type="file" class="form-control image-input" id="image"
                                    name="image" data-preview-target="#imagePreview"
                                    accept="image/jpeg,image/png,image/jpg,image/webp">

                                <small class="form-text text-muted d-block mt-1">
                                    ✅ Allowed formats: <strong>.jpeg, .jpg, .png, .webp</strong><br>
                                    📦 Max size: <strong>2MB</strong><br>
                                    🖼️ Recommended aspect ratio: <strong>1:1 (square)</strong>
                                </small>

                                <div class="col-12 mt-3">
                                    <img id="imagePreview" class="img-thumbnail w-100"
                                        style="max-height: 300px; display: none;" alt="Image Preview">
                                </div>
                            </div>

                            <div class="mb-3 col-md-12 form-group">
                                <label class="form-label" for="name">Price <span>*</span></label>
                                <input type="number" class="form-control" id="price" placeholder="Price"
                                    step="0.01" min="0" name="price">
                            </div>
                            <div class="modal-footer spinner">
                                <div class="mt-2">
                                    <div class="spinner-grow spinner-grow-sm me-1" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow spinner-grow-sm me-1" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="spinner-grow spinner-grow-sm me-1" role="status" style="display: none">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary saveBtn">Save Concession</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
