@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<ol class="breadcrumb container">
  <li><a href="index.html">Home</a></li>
  <li class="active"><a href="pricing.html">Pricing</a></li>
</ol>

<div id="pricing_section" class="container">
  <h3 class="text-center page-header">PACKAGES</h3>
  <div class="row">
    <div class="col-md-3">
      <div class="thumbnail">
       <img class="img-rounded img-responsive" src="{{URL('assets/img/featured/property-1.jpg')}}" >
       <div class="caption text-center">
        <p>No Agents</p>
        <hr>
        <p>0 Listings Monthly</p>
        <hr>
        <p>Whishlist Access</p>
        <hr>
        <p><a href="#" class="btn btn-warning btn-orange btn-block btn-lg" role="button">Register Now</a></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="thumbnail">
     <img class="img-rounded img-responsive" src="{{URL('assets/img/featured/property-2.jpg')}}" >
     <div class="caption text-center">
       <p>1 Agents</p>
       <hr>
       <p>10 Listings Monthly</p>
       <hr>
       <p>Whishlist Access</p>
       <hr>
       <p><a href="#" class="btn btn-warning btn-orange btn-block btn-lg" role="button">Register Now</a></p>
     </div>
   </div>
 </div>
 <div class="col-md-3">
  <div class="thumbnail">
   <img class="img-rounded img-responsive" src="{{URL('assets/img/featured/property-3.jpg')}}" >
   <div class="caption text-center">
     <p>5 Agents</p>
     <hr>
     <p>50 Listings Monthly</p>
     <hr>
     <p>Whishlist Access</p>
     <hr>
     <p><a href="#" class="btn btn-warning btn-orange btn-block btn-lg" role="button">Register Now</a></p>
   </div>
 </div>
</div>
<div class="col-md-3">
  <div class="thumbnail">
   <img class="img-rounded img-responsive" src="{{URL('assets/img/featured/property-4.jpg')}}" >
   <div class="caption text-center">
     <p>Unlinited Agents</p>
     <hr>
     <p>Unlimited Monthly</p>
     <hr>
     <p>Whishlist Access</p>
     <hr>
     <p><a href="#" class="btn btn-warning btn-orange btn-block btn-lg" role="button">Register Now</a></p>
   </div>
 </div>
</div>
</div>
</div>

<div>
  <section class="hero-price-section">
    <div class="container">
      <h4 class="text-uppercase">estato comes packed up with tons of features, don't miss it</h4>
      <button class="btn btn-default">Read More</button>
      <button class="btn btn-primary">Purchase Estato</button>
    </div>
  </section>
</div>

<div class="container">
  <h1 class="text-center text-uppercase page-header">our partners</h1>
  <div class="text-center">
   <img src="{{URL('assets/img/partners/partner-01.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-02.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-03.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-04.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-05.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-06.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-07.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-08.png')}}" class="img-responsive our-partners" alt="">
   <img src="{{URL('assets/img/partners/partner-09.png')}}" class="img-responsive our-partners" alt="">
 </div>
</div>
@endsection