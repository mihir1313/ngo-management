<div class="modal fade" id="causesModal" tabindex="-1" role="dialog" aria-labelledby="causesModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="causesModalLabel">Add Causes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="causes_form" id="causes_form" onsubmit="return false">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="error-div"></div>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Choose Image</label>
                            <input type="hidden" name="img_hid" id="img_hid">
                            <input class="form-control" type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="target" class="form-label">Target</label>
                            <input class="form-control" type="number" id="target" name="target">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-outline">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"
                                rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="hidden_id" name="hidden_id">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>