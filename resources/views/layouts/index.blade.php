<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('dashboard-title')</title>

    @yield('dashboard-header')

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('assets\css\animate.css') }}">
	
	<link rel="stylesheet" href="{{ asset('assets\css\owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets\css\owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets\css\magnific-popup.css') }}">


	<link rel="stylesheet" href="{{ asset('assets\css\bootstrap-datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('assets\css\jquery.timepicker.css') }}">

	<link rel="stylesheet" href="{{ asset('assets\css\flaticon.css')}}">
	<link rel="stylesheet" href="{{ asset('assets\css\style.css') }}">
</head>
<body>

	<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    {{-- <div class="wrap">
		<div class="container">
			<div class="row">
				<div class="col-md-6 d-flex align-items-center">
					<p class="mb-0 phone pl-md-2">
						<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a> 
						<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
					</p>
				</div>
				<div class="col-md-6 d-flex justify-content-md-end">
					<div class="social-media">
						<p class="mb-0 d-flex">
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

    @include('layouts.navbar')

    {{-- @include('layouts.slider') --}}

    @yield('dashboard-content')            


		
		<script>
			var BASE_URL ='http://127.0.0.1:8000';
		</script>
        @include('layouts.footer')


		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
		<script src="{{ asset('assets\js\jquery.min.js') }}"></script>
		<script src="{{ asset('assets\js\jquery-migrate-3.0.1.min.js') }}"></script>
		<script src="{{ asset('assets\js\popper.min.js') }}"></script>
		<script src="{{ asset('assets\js\bootstrap.min.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.easing.1.3.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.waypoints.min.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.stellar.min.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.animateNumber.min.js') }}"></script>
		<script src="{{ asset('assets\js\bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.timepicker.min.js') }}"></script>
		<script src="{{ asset('assets\js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('assets\js\jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('assets\js\scrollax.min.js') }}"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
   		 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		{{-- <script src="{{ asset('assets\js\google-map.js') }}"></script> --}}
		<script src="{{ asset('assets\js\main.js') }}"></script>
		<script src="{{ asset('assets\js\common.js') }}"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


        @yield('dashboard-footer')
		

</body>
</html>