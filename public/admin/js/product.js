$(document).ready(function () {
    list();
    $("#productModal").on('hidden.bs.modal', function () {

        $('#product_form')[0].reset();
        $("#hidden_id").val('');   

  
    });



    $("#add_product").on("click", function () {

        $("#productModal").modal("show");
    })

    $("#submit").on("click", function () {
        showloader();
        var data = $("#product_form").serialize();

        $.ajax({
            url: ADMIN_BASE_URL + "/product/save",
            type: "post",
            data: data,
            success: function (response) {
                var result = JSON.parse(response);

                if (result.status == 1) {
                    hideloader();
                    $("#productModal").modal("hide");
                    successMsg(result.msg);
                    list();
                } else {
                    errorMsg(result.msg);
                    hideloader();
                }
            }
        })

    })

    $(document).on("click", ".delete_id", function () {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                showloader();
                var delete_id = $(this).data("id");

                $.ajax({
                    url: ADMIN_BASE_URL + "/product/delete",
                    type: "post",
                    data: {
                        "_token": $("[name='_token']").val(),
                        delete_id: delete_id
                    },
                    success: function (response) {
                        var result = JSON.parse(response);

                        if (result.status == 1) {
                            hideloader();
                            successMsg(result.msg);
                            list();
                        } else {
                            errorMsg(result.msg);
                            hideloader();
                        }
                    }
                })
            }
        })
    })


    $(document).on("click", ".edit_id", function () {
        showloader();
        var edit_id = $(this).data("id");

        $.ajax({
            url: ADMIN_BASE_URL + "/product/edit",
            type: "post",
            data: {
                "_token": $("[name='_token']").val(),
                edit_id: edit_id
            },
            success: function (response) {

                var result = JSON.parse(response);
                
              if(result.status==1){
                hideloader();
                $("#productModal").modal("show");
                $("#name").val(result.data.name);
                $("#description").val(result.data.description);
                $("#price").val(result.data.price);
                $("#quality").val(result.data.quality);
                $("#category").val(result.data.category);
                $("#brand").val(result.data.brand); 
                $("#status").val(result.data.status);
                $("#hidden_id").val(result.data.id);   
              }else{
                errorMsg(result.data);
                hideloader();
              }

            }
        })
    })

})


function list() {


    showloader();
    $('#product_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/products",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'name' },
            { data: 'description' },
            { data: 'price' },
            { data: 'category_name' },
            { data: 'brand_name' },
            { data: 'quality' },
            { data: 'status' },
            { data: 'created_at' },
            { data: 'action' },

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [9],
            "orderable": false
        }]
    });
    hideloader();



}