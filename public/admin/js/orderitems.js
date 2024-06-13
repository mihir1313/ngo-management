$(document).ready(function(){

    list();
})


function list() {

    showloader();
    $('#Orderitems_datatable').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        "destroy": true,
        'ajax': {
            'url': ADMIN_BASE_URL + "/orders/items",
            'type': "post",
            'data': {
                "_token": $("[name='_token']").val(),
                "order_id": $("#order_id").val(),
            }
        },

        'columns': [
            { data: 'id' },
            { data: 'product_name' },
            { data: 'quantity' },
            { data: 'product_price' },
            { data: 'total_price' },
            { data: 'product_data' },
            { data: 'created_at' },
           
        

        ],
        "order": [[0, "ASC"]],
        "columnDefs": [{
           "targets": [5],
            "orderable": false
        }]
    });
    hideloader();
    
}