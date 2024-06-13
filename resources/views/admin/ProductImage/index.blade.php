@extends('admin.layouts.index')
@section('Title','ProductImage')
@section('TitleHeader','Product Image')

@section('MainContant')
@include('admin/ProductImage/modal')
<style>
    .wrapper {
        background: #39E2B6;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        z-index: 9999;
        text-align: center;
        left: 0;
        font-size: 100px;
        font-family: calibri;
        color: white;
        line-height: 100vh;
    }

    .dropzone {
        width: 98%;
        margin: 1%;
        border: 2px dashed #3498db !important;
        border-radius: 5px;
    }
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-body wizard-content">
            <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_productimage" class=" btn btn-success">Add Product Image</button>
            </div>
            <hr>

            <div class="table-responsive">
                <table id="productimage_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


</div>
@endsection
@section('FooterScript')
<script src="{{asset('admin/js/productImage.js')}}"></script>
<script>
    var CSRF_TOKEN = $("[name='_token']").val();
    var id =$("#product_id").val();
    var myDropzone = new Dropzone(".dropzone",{ 
            maxFilesize: 3,  // 3 mb
            // maxFiles: 4,
             acceptedFiles: ".jpeg,.jpg,.png,.webp",
            parallelUploads:10,
            uploadMultiple: true,
            autoProcessQueue: false
        });
        myDropzone.on("sending", function(file, xhr, formData) {
                 formData.append("_token", CSRF_TOKEN);
                 formData.append("product_id", id);
            }); 
            myDropzone.on("complete", function(file) {
                    $("#productimageModal").modal("hide");
                    window.location.reload();
                    // load();
                    this.removeAllFiles(true);
            });
            
    $("#productimageModal").on("hidden.bs.modal", function () {
         myDropzone.removeAllFiles(true);
     });
        $("#submit").on('click',function () {
            myDropzone.processQueue();
            
        })
</script>


@endsection