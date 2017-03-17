@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<ol class="breadcrumb container">
  <li><a href="index.html">Home</a></li>
  <li class="active"><a href="login.html">Registration</a></li>
</ol>

<section id="register_section">
  <div class="container">
    <div class="row">
      <div class="col-md-8 text-center">
        <h1>WHAT WILL YOU <span class="highlight">EARN</span> BY <br> REGISTERING?</h1>
        <hr>
        <div class="col-md-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <a href=""><i class="fa fa-users fa-inverse fa-stack-1x"></i></a>
          </span>
          <h4 class="text-uppercase">get more users</h4>
          <p>Thanks to our content optimization you will get more visits to your property page.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <a href=""><i class="fa fa-bolt fa-inverse fa-stack-1x"></i></a>
          </span>
          <h4 class="text-uppercase">convert visitors</h4>
          <p>With our design and structures you will be able to show your property in better light.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <a href=""><i class="fa fa-trophy fa-inverse fa-stack-1x"></i></a>
          </span>
          <h4 class="text-uppercase">reach your goal</h4>
          <p>Estato was designed to become your real estate business partner. It’s not only a tool, it’s a working ecosystem.</p>
        </div>
        <br><br>
      </div>
      <div class="col-md-4 container-box">

       

        <form class="form-hrizontal" data-request="onRegister">
          <div id="searchPropertyBtn" class="input-group">
            <span class="input-group-btn text-center">
              <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-user"></i>
              </button> 
              <button class="btn btn-primary text-uppercase btn-lg">become a member</button>  
            </span>
          </div>
          <div class="form-group">
            <label for="">Your Email:</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Password:</label>
            <input type="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Confirm Password:</label>
            <input type="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="">Account Type:</label>
            <select name="" id="" class="form-control">
              <option value="">Standard User</option>
              <option value="">Premium User</option>
            </select>
          </div>
          <div class="form-group">
            <input type="checkbox">
            <label for="">I read and agree to <a href="">terms & conditions</a></label>
          </div>
          <div class="form-group">
            <button class="btn btn-warning btn-lg btn-orange btn-block">Register</button>
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