$(document).ready(function () {
    list();
    $('#userModal').on('hidden.bs.modal', function () {
        $('#user_form')[0].reset();
        $('#hidden_id').val('');
    });

    $("#add_user").on("click", function () {
        $('#userModal').modal('show');
    })

    $("#submit").on("click", function () {
        showloader();
        var data = $('#user_form').serialize();
        $.ajax({
            url: ADMIN_BASE_URL + "/user/save",
            type: "post",
            data: data,
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status == 1) {
                    hideloader();
                    $('#userModal').modal('hide');
                    successMsg(result.msg);
                    list();
                } else {
                    errorMsg(result.msg);
                  hideloader();
                }
            }
        });
    })

        //  delete

   $(document).on("click",".delete_id",function(){
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
                        url: ADMIN_BASE_URL + "/user/delete",
                        type: "post",
                        data: {
                            "_token": $("[name='_token']").val(), 
                            "delete_id":delete_id 
                        },
                        success: function (response){
                        var result =JSON.parse(response);
                       
                        if(result.status==1){
                           
                            successMsg(result.msg);
                          list();
                          hideloader();
                        }else{
                            errorMsg(result.msg);
                            hideloader();
                        }
         

                        }
                    })
                    
                }
              })
            })


            // edit

$(document).on("click",".edit_id",function(){
    showloader();
var edit_id = $(this).data("id");
$.ajax({
    url: ADMIN_BASE_URL + "/user/edit",
    type: "post",
    data: {
        "_token": $("[name='_token']").val(), 
        "edit_id":edit_id 
    },
    success: function (response){
        var result=JSON.parse(response);
     if(result.status==1){
        hideloader();
        $('#userModal').modal('show');
        $('#name').val(result.data.name);
        $('#email').val(result.data.email);
        $('#status').val(result.data.status);
        $('#hidden_id').val(result.data.id);
     }else{
        errorMsg(result.data);
        hideloader();
     }


    }
})


})

});

// list

function list() {
    showloader();
    $('#user_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/users",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
            }
        },
        'columns': [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'status' },
            { data: 'created_at' },
            { data: 'action' },
            
        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [5],
            "orderable": false
        }]
    });
    hideloader();
}

// Swal.fire({
//     title: 'Are you sure?',
//     text: "You won't be able to revert this!",
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, delete it!'
//   }).then((result) => {
//     if (result.isConfirmed) {
   
//     }
//   })