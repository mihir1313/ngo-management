$(document).ready(function () {
    list();
    $('#brandModal').on('hidden.bs.modal', function () {
        $('#brand_form')[0].reset();
        $('#hidden_id').val('');

    });

    $("#add_brand").on("click", function () {
        $("#brandModal").modal("show");
    })

    $("#submit").on("click", function () {
        showloader();
        var data = $('#brand_form').serialize();
        $.ajax({
            url: ADMIN_BASE_URL + "/brand/save",
            type: "post",
            data: data,
            success: function (response) {

                var result = JSON.parse(response);

                if (result.status == 1) {
                    hideloader();
                    $("#brandModal").modal("hide");
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
            if (result.isConfirmed){
        showloader();
        var delete_id = $(this).data("id");

        $.ajax({
            url: ADMIN_BASE_URL + "/brand/delete",
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
            url: ADMIN_BASE_URL + "/brand/edit",
            type: "post",
            data: {
                "_token": $("[name='_token']").val(),
                edit_id: edit_id
            },
            success: function (response) {
                var result = JSON.parse(response);

                if (result.status == 1) {
                    hideloader();
                    $("#brandModal").modal("show");
                    $("#name").val(result.data.name);
                    $("#status").val(result.data.status);
                    $("#hidden_id").val(result.data.id);
                } else{
                    errorMsg(result.data);
                    hideloader();

                }
            }
        })

    })



})


function list() {

    showloader();
    $('#brand_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/brand",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'name' },
            { data: 'status' },
            { data: 'created_at' },
            { data: 'action' },

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [4],
            "orderable": false
        }]
    });
    hideloader();

}