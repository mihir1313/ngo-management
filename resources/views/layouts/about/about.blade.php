@extends('layouts.index')
@section('dashboard-title','About')
@section('dashboard-content')
@php

@endphp
<section class="hero-wrap hero-wrap-2"  style="background-image: url('{{ asset('assets/images/bg_2.jpg')  }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-end">
        <div class="col-md-9 ftco-animate pb-5">
         <p class="breadcrumbs mb-2"><span class="mr-2"><a  href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About us <i class="ion-ios-arrow-forward"></i></span></p>
         <h1 class="mb-0 bread">About Us</h1>
       </div>
     </div>
   </div>
  </section>
<div class="container">
    <div class="row d-flex no-gutters">
     <div class="col-md-6 d-flex order-md-last">
      <div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/about-1.jpg);">
      </div>
    </div>
    <div class="col-md-12 pr-md-5 py-md-5">
      <div class="heading-section pt-md-5 mb-4">
       <span class="subheading">About us</span>
       <h2 class="mb-2">Give a helping hand to a needy people</h2>
       <p>Unicare is a non-profit organization based in Ahmedabad, India, dedicated to making a positive impact on the lives of individuals and communities. Our mission is to uplift the underprivileged, advocate for social justice, and drive sustainable development.</p>
       <p>With a team of passionate volunteers and dedicated professionals, we strive to address pressing social issues such as poverty, education inequality, healthcare disparities, and gender inequality. Our efforts are guided by the belief that every person deserves equal opportunities and a chance to lead a dignified life.</p>
       <p>Through our various initiatives and programs, we aim to empower marginalized communities by providing access to education, healthcare, skill development, and livelihood opportunities. We work in collaboration with local partners, government agencies, and community leaders to develop sustainable solutions tailored to the specific needs of the communities we serve.</p>
   <p>Education is at the core of our work, as we recognize it as a powerful tool for empowerment. We establish and support educational programs, scholarships, and infrastructure projects to ensure that children and youth have access to quality education. By investing in education, we aim to break the cycle of poverty and create a brighter future for the next generation.</p>
  <p>Healthcare is another vital aspect of our work. We strive to improve access to healthcare services, especially in remote and underserved areas. Our initiatives focus on preventive care, health awareness, and providing medical assistance to those in need. We believe that good health is essential for individuals to thrive and contribute to their communities.</p> 
<p>At [NGO Name], we are also committed to promoting gender equality and women's empowerment. We work towards creating safe spaces, providing skill-building opportunities, and advocating for women's rights. By empowering women, we strive to create a more inclusive and equitable society for all.</p>  
<p>We believe in the power of collective action and actively engage with volunteers, donors, and like-minded organizations to maximize our impact. Together, we can create sustainable change and uplift those who need it the most.</p>
<p>Join us in our mission to build a more just, inclusive, and compassionate society. Together, we can make a difference and create a brighter future for all.</p>
<p>Unicare - Empowering Lives, Inspiring Change.</p>
</div>
   </div>
  </div>
  </div>

@endsection