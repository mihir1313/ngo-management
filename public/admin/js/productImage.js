$(document).ready(function () {
    list();

    $("#add_productimage").on("click", function () {
        $("#productimageModal").modal("show");
    });



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
                url: ADMIN_BASE_URL + "/product/image/delete",
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


function list() {

    showloader();
    $('#productimage_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/product/images",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
                "product_id": $("#product_id").val()
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'img' },
            { data: 'created_at' },
            { data: 'action' },

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [1, 3],
            "orderable": false
        }]
    });
    hideloader();


}



