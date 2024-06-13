$(document).ready(function(){

    list();

    $('#submit').on("click", function () {
        showloader();
        var formData = new FormData($('#causes_form')[0]);
        

        $.ajax({
            url: ADMIN_BASE_URL + "/causes/save",
            type: 'post',
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (response) {
                var result = JSON.parse(response);

                if (result.status == 1) {
                    hideloader();
                    $("#causesModal").modal("hide");
                    list();
                    successMsg(result.msg);
                } else {
                    errorMsg(result.msg);
                    hideloader();
                }

            }
        })
    })

    $("#causesModal").on("hidden.bs.modal", function () {
        $("#causes_form")[0].reset();
        $("#hidden_id").val("");
        $("#causes_form").validate().resetForm();
        $("#causes_form").find('.error').removeClass('error');
    });

})

$("#add_causes").on("click", function () {
    $("#causesModal").modal("show");
});




$(document).on('click','#editId',function(){
    var editId = $(this).data('id');

    $.ajax({
        url: ADMIN_BASE_URL + "/causes/edit",
        type: "post",
        data: {
            "_token": $("[name='_token']").val(),
            "id": editId
        },
        success: function (response) {
            var result = JSON.parse(response);
            console.log(result.data)
            if (result.status == 1) {
                $("#causesModal").modal("show");
                $("#hidden_id").val(result.data.id);
                $("#title").val(result.data.title);
                $("#target").val(result.data.target);
                $("#description").val(result.data.description);
                $("#img_hid").val(result.data.img);
                $("#target").val(result.data.target);
            } else {
                errorMsg(result.data);
                hideloader();

            }
        }
    })
})


$(document).on("click", "#deleteId", function () {

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
            var deleteId = $(this).data("id");
            $.ajax({
                url: ADMIN_BASE_URL + "/causes/delete",
                type: "post",
                data: {
                    "_token": $("[name='_token']").val(),
                    "id": deleteId
                },
                success: function (response) {
                    var result = JSON.parse(response);
                    console.log(result)
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


function list() {
 
    showloader();
    $("#causes_datatable").DataTable({
        processing: true,
        "bDestroy": true,
        "bAutoWidth": false,
        serverSide: true,
        searching: false,
        ajax: {
            type: "POST",
            url:ADMIN_BASE_URL + "/causes/list",
            data: {
                "_token": $("[name='_token']").val(),
            }
        },
        columns: [
            { data: "title", name: "title" },
            { data: "img", name: "img" },
            { data: "target", name: "target" },
            { data: "donation", name: "donation" },
            { data: "description", name: "description" },
            { data: "created_at", name: "created_at" },
            { data: "action", name: "action" },
        ],
    });
    hideloader();

}