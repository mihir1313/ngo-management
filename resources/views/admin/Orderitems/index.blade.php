@extends('admin.layouts.index')
@section('Title','Orders')
@section('TitleHeader','Orders')

@section('MainContant')


<?php 
// echo '<pre>';
// print_r($id);
// die;
?>
<div class="container-fluid">
    @csrf
    <input type="hidden" id="order_id" value="{{$id}}">
    <div class="card">
        <div class="card-body wizard-content">
            <hr>
            <div class="table-responsive">
                <table id="Orderitems_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Created At</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


</div>
@endsection
@section('FooterScript')
<script src="{{asset('admin/js/orderitems.js')}}"></script>
@endsection