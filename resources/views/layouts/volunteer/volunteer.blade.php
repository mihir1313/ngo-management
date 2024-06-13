@extends('layouts.index')
@section('dashboard-title','Volunteer')
@section('dashboard-content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('assets/images/bg_2.jpg')  }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate pb-5">
         <p class="breadcrumbs mb-2"><span class="mr-2"><a  href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Volunteer <i class="ion-ios-arrow-forward"></i></span></p>
         <h1 class="mb-0 bread">Volunteer</h1>
       </div>
     </div>
   </div>
  </section>
<div class="container mt-2">
    <div class="row justify-content-center pb-5 mb-3 mt-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
       <span class="subheading">Volunteer</span>
       <h2>Our Expert Volunteer</h2>
     </div>
   </div>
   <div class="row">

  @if (isset($volunteers) && count($volunteers) > 0)
    {{-- @php
      echo '<pre>';
        print_r($volunteers);
        die;
    @endphp --}}
    @foreach ($volunteers as $key => $data)
    @php
      $customKey = ++$key;
    @endphp
    <div class="col-md-6 col-lg-3">
      <div class="volunteer">
       <div class="img" style="background-image: url('{{ asset('uploads/volunteer/'.$data['img']) }}');"></div>
       <div class="text text-{{ $customKey }}">
        <h3>{{ ucfirst($data['name']) }}</h3>
        <span>Volunteer</span>
      </div>
    </div>
    </div>
    @endforeach
  @else
  <div class="col-md-6 col-lg-3">
    <div class="volunteer">
     <div class="img" style="background-image: url('{{ asset('assets/images/person_1.jpg')  }}');"></div>
     <div class="text text-1">
      <h3>Mihir Chauhan</h3>
      <span>Volunteer</span>
    </div>
  </div>
</div>
  @endif  
  </div>
  </div>
@endsection
