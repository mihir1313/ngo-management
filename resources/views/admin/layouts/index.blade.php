<!DOCTYPE html>
<html dir="ltr" lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/images/favicon-icon.png')}}">
    <title>Admin | @yield('Title')</title>
    <!-- Custom CSS -->
    <link href="{{asset('admin/libs/flot/css/float-chart.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('admin/dist/css/style.min.css')}}" rel="stylesheet">
    {{--
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
    <link href="{{asset('admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
</head>

<body>
   
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <div id="main-wrapper">
       
        {{-- Navbar --}}
        @include('admin.layouts.navbar')
        {{-- Navbar End --}}
     
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        @include('admin.layouts.sidebar')
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">@yield('TitleHeader')</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Container fluid  --> 
            @yield('MainContant')
            <!-- End Container fluid  -->

            <!-- footer -->
           @include('admin.layouts.footer')
           <!-- End footer -->
           
        </div>
       <!-- End Page wrapper  -->
        
    </div>
   
    <!-- End Wrapper -->
   
    <!-- All Jquery -->
    <script src="{{asset('admin/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->

    <script src="{{asset('admin/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('admin/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('admin/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('admin/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('admin/dist/js/custom.min.js')}}"></script>
   
    {{-- <script src="dist/js/pages/dashboards/dashboard1.js"></script>  --}}
    <!-- Charts js Files -->

    <script>
        var ADMIN_BASE_URL ='<?php echo url("admin");?>';

    
    </script>
    <script src="{{asset('admin/libs/flot/excanvas.js')}}"></script>
    <script src="{{asset('admin/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('admin/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('admin/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('admin/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{asset('admin/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/pages/chart/chart-page-init.js')}}"></script>
    <script src="{{asset('admin/extra-libs/DataTables/datatables.min.js')}}"></script>
     {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>  --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
    <script>

        
    </script>

    <script src="{{asset('admin/js/common.js')}}"></script>

    @yield('FooterScript')
</body>

</html>