@extends('layouts.index')
@section('dashboard-title','Causes')
@section('dashboard-header')
<link rel="stylesheet" href="{{asset('assets/css/thankyou.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/stripe.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/paymentsuceesfully.css')}}">

@endsection
@section('dashboard-content')
<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('assets/images/bg_2.jpg')  }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate pb-5">
         <p class="breadcrumbs mb-2"><span class="mr-2"><a  href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Causes<i class="ion-ios-arrow-forward"></i></span></p>
         <h1 class="mb-0 bread">Causes</h1>
       </div>
     </div>
   </div>
  </section>
  {{-- @php
  echo '<pre>';
  print_r($donation);
  die;
  @endphp --}}
<div class="container">
    <div class="row mt-5">

      @if (isset($causes) && count($causes) > 0)
        
      @foreach ($causes as $key => $value)
        
      <div class="col-md-6 col-lg-3">
        <div class="causes causes-2 text-center ftco-animate">
         <a href="#" class="img w-100" style="background-image: url('{{ asset('uploads/causes/'. $value['img'])  }}');"></a>
         <div class="text p-3">
           <h2 id="causeHeading{{$value['id']}}">{{ $value['title'] }}</h2>
           <p>{{ $value['description'] }}</p>
           <div class="goal mb-4">
             <p><span>{{  $value['target'] - $value['donation'] }}</span> to go</p>
             @php
             $sum = round( ($value['donation'] * 100) / $value['target']);
        
             
             $sum =  isset($sum) &&  $sum != '' ? $sum : 0;
             @endphp
             <div class="progress" style="height:20px">
               <div class="progress-bar progress-bar-striped" style="width:{{ $sum }}%; height:20px">{{ $sum }}%</div>
             </div>
           </div>
           <p><button class="btn btn-light w-100" data-id="{{ $value['id'] }}" id="donateBtn" {{ $sum == 100 ? 'disabled' : '' }}>Donate Now</button></p>
         </div>
       </div>
     </div>
     @endforeach

      @else

      <div class="col-md-6 col-lg-3">
       <div class="causes causes-2 text-center ftco-animate">
        <a href="#" class="img w-100"  style="background-image: url('{{ asset('assets/images/causes-1.jpg')  }}');"></a>
        <div class="text p-3">
          <h2><a href="#">Save the poor children from hunger</a></h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia</p>
          <div class="goal mb-4">
            <p><span>$3,800</span> to go</p>
            <div class="progress" style="height:20px">
              <div class="progress-bar progress-bar-striped" style="width:70%; height:20px">70%</div>
            </div>
          </div>
          <p><button class="btn btn-light w-100">Donate Now</button></p>
        </div>
      </div>
    </div>
        
      @endif
  </div>
  </div>
@endsection
 @section('dashboard-footer')
 @include('layouts.donate.donate-modal')
 @include('layouts.donate.paymentsuceesfully')
<script src="{{ asset('assets\js\donate.js') }}"></script>

@endsection 
