@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<ol class="breadcrumb container">
  <li><a href="index.html">Home</a></li>
  <li class="active"><a href="about-us.html">About Us</a></li>
</ol>


<div>
  <section id="about_us" class="text-center">
    <h1>Our mission is to bring you the most <span class="highlight">clean</span><br> and <span class="highlight">user friendly</span> real estate portal.</h1>
    <br>
    <a href="properties.html"><button class="btn btn-trans btn-primary btn-lg">Properties</button></a>
  </section>
</div>

<div id="about_section" class="container">
  <h3 class="text-uppercase page-header text-center">our agents</h3>
  <div class="row">
    <div class="col-md-3">
      <div class="thumbnail">
        <img class="img-rounded img-responsive" src="{{URL('assets/img/agents/agents-1.png')}}" >
        <div class="caption">
          <h4>Raghvendr Pratap Singh</h4>
          <a href="">15 Properties</a>
          <hr>
          <p><i class="fa fa-phone"></i> (123) 456 7890</p>
          <p><i class="fa fa-mobile"></i> 999 999 9999</p>
          <p><i class="fa fa-skype"></i> raghvendra</p>
          <p><i class="fa fa-envelope"></i> codingbrains2@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="thumbnail">
        <img class="img-rounded img-responsive" src="{{URL('assets/img/agents/agents-1.png')}}" >
        <div class="caption">
          <h4>Bipin Rony</h4>
          <a href="">15 Properties</a>
          <hr>
          <p><i class="fa fa-phone"></i> (123) 456 7890</p>
          <p><i class="fa fa-mobile"></i> 999 999 9999</p>
          <p><i class="fa fa-skype"></i> bipin </p>
          <p><i class="fa fa-envelope"></i> codingbrains9@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="thumbnail">
        <img class="img-rounded img-responsive" src="{{URL('assets/img/agents/agents-1.png')}}" >
        <div class="caption">
          <h4>Shubhanshu Jaiswal</h4>
          <a href="">15 Properties</a>
          <hr>
          <p><i class="fa fa-phone"></i> (123) 456 7890</p>
          <p><i class="fa fa-mobile"></i> 999 999 9999</p>
          <p><i class="fa fa-skype"></i> Shubhanshu</p>
          <p><i class="fa fa-envelope"></i>codingbrains16@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="thumbnail">
        <img class="img-rounded img-responsive" src="{{URL('assets/img/agents/agents-1.png')}}" >
        <div class="caption">
          <h4>Vikas Shukla</h4>
          <a href="">15 Properties</a>
          <hr>
          <p><i class="fa fa-phone"></i> (123) 456 7890</p>
          <p><i class="fa fa-mobile"></i> 999 999 9999</p>
          <p><i class="fa fa-skype"></i> vikas</p>
          <p><i class="fa fa-envelope"></i> codingbrains11@gmail.com</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

