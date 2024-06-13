$(document).ready(function () {


    list();



})
function list() {


    showloader();
    $('#orders_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/orders",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
               
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'user_id' },
            { data: 'transaction_id' },
            { data: 'subtotal' },
            { data: 'total' },
            { data: 'transaction_status' },
            { data: 'address' },
            { data: 'created_at' },
            { data: 'action' },

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
            "targets": [8],
            "orderable": false
        }]
    });
    hideloader();
}