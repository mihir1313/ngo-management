<div class="modal fade" id="volunteerModal" tabindex="-1" role="dialog" aria-labelledby="volunteerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="volunteerModalLabel">Add Volunteer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="volunteer_form" id="volunteer_form" onsubmit="return false">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="error-div"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Choose Image</label>
                            <input class="form-control" type="file" id="image" name="image"  accept="image/png, image/gif, image/jpeg">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1">Active</option>
                            <option value="0">In Active</option>
                        </select>
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