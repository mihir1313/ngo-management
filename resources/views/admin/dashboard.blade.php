@extends('admin.layouts.index')
@section('Title','Dashboard')
@section('TitleHeader','Dashboard')

@section('MainContant')
<div class="container-fluid">

    @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        @if(is_array(session('success')))
        <ul style="list-style: none !important;">
            @foreach (session('success') as $message)
            <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
        {{ session('success') }}
        @endif
    </div>
    @endif

    
    <div class="row">
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                    <h6 class="text-white">Dashboard</h6>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <a href="{{url('/admin/users')}}">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                    <h6 class="text-white">Users</h6>
                </div>
            </a>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <a href="{{url('admin/category')}}">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-format-list-bulleted"></i></h1>
                    <h6 class="text-white">Category</h6>
                </div>
            </a>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <a href="{{url('admin/brand')}}">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="fas fa-bold"></i></h1>
                    <h6 class="text-white">Brand</h6>
                </div>
            </a>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <a href="{{url('admin/products')}}">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="fab fa-product-hunt"></i></h1>
                    <h6 class="text-white">Product</h6>
                </div>
            </a>
            </div>
        </div>
    
    
        {{-- <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                    <h6 class="text-white">Forms</h6>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                    <h6 class="text-white">Buttons</h6>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
                    <h6 class="text-white">Elements</h6>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-calendar-check"></i></h1>
                    <h6 class="text-white">Calnedar</h6>
                </div>
            </div>
        </div>
    
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                    <h6 class="text-white">Errors</h6>
                </div>
            </div>
        </div> --}}
    
    </div>
   
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Site Analysis</h4>
                            <h5 class="card-subtitle">Overview of Latest Month</h5>
                        </div>
                    </div>
                    <div class="row">
                    
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-user m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">2540</h5>
                                        <small class="font-light">Total Users</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-plus m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">120</h5>
                                        <small class="font-light">New Users</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-cart-plus m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">656</h5>
                                        <small class="font-light">Total Shop</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-tag m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">9540</h5>
                                        <small class="font-light">Total Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-table m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">100</h5>
                                        <small class="font-light">Pending Orders</small>
                                    </div>
                                </div>
                                <div class="col-6 m-t-15">
                                    <div class="bg-dark p-10 text-white text-center">
                                        <i class="fa fa-globe m-b-5 font-16"></i>
                                        <h5 class="m-b-0 m-t-5">8540</h5>
                                        <small class="font-light">Online Orders</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection