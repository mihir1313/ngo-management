$(document).ready(function () {
    list();

    $('#categoryModal').on('hidden.bs.modal', function () {
        $('#category_form')[0].reset();
        $('#hidden_id').val('');

    });

    $("#add_category").on("click", function () {
        $("#categoryModal").modal("show");
    })



    $('#submit').on("click", function () {
        showloader();
        var formData = new FormData($('#category_form')[0]);

        $.ajax({
            url: ADMIN_BASE_URL + "/category/save",
            type: 'post',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (response) {
                var result = JSON.parse(response);

                if (result.status == 1) {
                    hideloader();
                    $("#categoryModal").modal("hide");
                    list();
                    successMsg(result.msg);

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
                    url: ADMIN_BASE_URL + "/category/delete",
                    type: "post",
                    data: {
                        "_token": $("[name='_token']").val(),
                        "delete_id": delete_id
                    },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status == 1) {
                            successMsg(result.msg);
                            list();
                            hideloader();
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
            url: ADMIN_BASE_URL + "/category/edit",
            type: "post",
            data: {
                "_token": $("[name='_token']").val(),
                "edit_id": edit_id
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 1) {
                    hideloader();
                    $("#categoryModal").modal("show");
                    $("#name").val(result.data.name);
                    $("#status").val(result.data.status);
                    $("#hidden_id").val(result.data.id);
                } else {
                    errorMsg(result.data);
                    hideloader();

                }
            }
        })


    })



})

function list() {
    showloader();
    $('#category_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/category",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'name' },
            { data: 'img' },
            { data: 'status' },
            { data: 'created_at' },
            { data: 'action' },

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [2, 5],
            "orderable": false
        }]
    });
    hideloader();

}

