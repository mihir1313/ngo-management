<div class="modal fade" id="productimageModal" tabindex="-1" role="dialog" aria-labelledby="productimageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productimageModalLabel">Add Product Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="wrapper" style="visibility:hidden; opacity:0">DROP HERE</div>


            <form action="{{route('admin.product.image.save')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                @csrf
                <div class="dz-message ">
                    <span class="text">
                        Drop files here or click to upload +
                    </span>

                </div>
                <input type="hidden" name="product_id" id="product_id" value="{{$id}}">
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submit" class="btn btn-primary">Submit</button>
            </div>


        </div>
    </div>
</div>