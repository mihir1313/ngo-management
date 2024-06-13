<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="product_form" id="product_form" onsubmit="return false">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div id="error-div"></div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <div class="form-outline">
                            <label class="form-label" for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description"
                                rows="4"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                            </div>
                        </div>
                        <div class="col">
                             <div class="form-group">
                            <label for="quality">Quality</label>
                            <input type="text" class="form-control" id="quality" name="quality" placeholder="Quality">
                        </div></div>
                    </div>
                    
                   <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" class="form-control" id="category">
                                @if(!empty($categories))
                                <option value="" disabled selected>Select Your Category </option>
                                @foreach($categories as $key => $catgory)
                                <option value="{{$catgory['id']}}">{{$catgory['name']}}</option>
                                @endforeach
                                @endif
                               
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select name="brand" class="form-control" id="brand">
                                @if(!empty($brands))
                                <option value="" disabled selected>Select Your Brand</option>
                                @foreach($brands as $key => $brand)
                                <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
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