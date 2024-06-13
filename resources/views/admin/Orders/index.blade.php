@extends('admin.layouts.index')
@section('Title','Orders')
@section('TitleHeader','Orders')

@section('MainContant')

<div class="container-fluid">
@csrf
    <div class="card">
        <div class="card-body wizard-content">
            
            <hr>

            <div class="table-responsive">
                <table id="orders_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Users</th>
                            <th scope="col">Transaction Id</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Transaction Status</th>
                            <th scope="col">Shipping Address</th>
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
<script src="{{asset('admin/js/orders.js')}}"></script>
@endsection