@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<ol class="breadcrumb container">
  <li><a href="index.html">Home</a></li>
  <li class="active"><a href="contact.html">Contact Us</a></li>
</ol>

<section id="contact_section">
  <div class="container">
    <div class="row">
      <div id="map-container" class="col-md-8 text-center hidden-sm hidden-xs">
        <br><br>
      </div>
      <div class="col-md-4 container-box">
        <form class="form-hrizontal">
          <div id="searchPropertyBtn" class="input-group">
            <span class="input-group-btn text-center">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-envelope"></i>
              </button> 
              <button class="btn btn-primary text-uppercase btn-lg">send us a message</button>  
            </span>
          </div>
          <div class="form-group">
            <label for="">Your Name:</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Phone:</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Email:</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Choose Topic:</label>
            <select name="" id="" class="form-control">
              <option value="">General Inquaries</option>
              <option value="">Misc</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Message:</label>
            <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-warning btn-lg btn-orange">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="hero-section">
    <div class="container">
      <p class="lead pull-left text-uppercase">
        a great place to be Real Estate
      </p>
      <p class="hero-btn">
        <button class="btn btn-lg btn-info pull-right">Read More</button>
        <button class="btn btn-lg btn-danger pull-right">List Property</button>
      </p>
    </div>
  </div>
  <div class="div-pattern"></div>
</section>


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