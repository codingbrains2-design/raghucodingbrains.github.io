@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<div id="layout-slider">
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<img src="{{ URL('assets/slider/slider-1.jpg')}}" class="img-responsive" alt="slider-image">
			</div>
			<div class="item">
				<img src="{{ URL('assets/slider/slider-2.jpg')}}" class="img-responsive" alt="slider-image">
			</div>
			<div class="item">
				<img src="{{ URL('assets/slider/slider-3.jpg')}}" class="img-responsive" alt="slider-image">
			</div>
			<div class="item">
				<img src="{{ URL('assets/slider/slider-4.jpg')}}" class="img-responsive" alt="slider-image">
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next">&rsaquo;</a>
	</div>
</div>
<div class="container">
	
	<div id="layout-search">
		<section id="searchProperty" class="container-box">
			<form class="form-horizontal" role="form">
				<div id="searchPropertyBtn" class="input-group">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary btn-lg">
							<i class="fa fa-search"></i>
						</button> 
						<button class="btn btn-primary text-uppercase btn-lg">search for property</button>  
					</span>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label for="input">Property Id</label>
						<input type="text" required id="input" placeholder="Any" class="form-control input-lg">
					</div>
					<div class="col-md-3">
						<label for="location">Location</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">New York</option>
							<option value="2">New Jersey</option>
							<option value="3">Newark</option>
							<option value="4">Philadelphia</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="sub_location">Sub-Location</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">New York</option>
							<option value="2">New Jersey</option>
							<option value="3">Newark</option>
							<option value="4">Philadelphia</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="prop_status">Property Status</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">New York</option>
							<option value="2">New Jersey</option>
							<option value="3">Newark</option>
							<option value="4">Philadelphia</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="prop_type">Property type</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">New York</option>
							<option value="2">New Jersey</option>
							<option value="3">Newark</option>
							<option value="4">Philadelphia</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="bedroom">Bedroom</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3+</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="bathroom">Bathroom</label>
						<select class="form-control input-lg">
							<option value="any">Any</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3+</option>
						</select>
					</div>
					<div class="col-md-3">
						<label for="" class="text-uppercase">Search for Property</label>
						<button type="submit" class="btn btn-warning btn-lg btn-block btn-orange">Search Now</button>
					</div>
				</div>
			</form>
		</section>
	</div>
</div>

<div>
	<section id="">
		<div class="col-md-9">
			<h3 class="text-uppercase page-header">featured listings</h3>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img class="img-rounded" src="{{URL('assets/img/featured/property-1.jpg')}}" >
						<div class="caption text-center">
							<a href=""> 8553 Fallen Creek Bend,<br> North Carolina</a>
							<p><del>$ 450,000</del> <ins> $ 350,000</ins></p>
							<p>Beautiful apartment in a great, very calm and safe place.</p>
							<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img class="img-rounded" src="{{URL('assets/img/featured/property-2.jpg')}}" >
						<div class="caption text-center">
							<a href=""> 9544 Umber View,<br> Inspiration</a>
							<p><ins> $ 450,000</ins></p>
							<p>Beautiful apartment in a great, very calm and safe place.</p>
							<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
						<img class="img-rounded" src="{{URL('assets/img/featured/property-3.jpg')}}" >
						<div class="caption text-center">
							<a href=""> 4079 Broad Falls,<br> Turkeytown</a>
							<p><ins> $ 450,000</ins></p>
							<p>Beautiful apartment in a great, very calm and safe place.</p>
							<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
						</div>
					</div>
				</div>            <div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img class="img-rounded" src="{{URL('assets/img/featured/property-4.jpg')}}" >
					<div class="caption text-center">
						<a href="">046 Merry Landing,<br> High Lonesome Wells</a>
						<p><ins> $ 350,000</ins></p>
						<p>Beautiful apartment in a great, very calm and safe place.</p>
						<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img class="img-rounded" src="{{URL('assets/img/featured/property-5.jpg')}}" >
					<div class="caption text-center">
						<a href="">8606 Quaking Grove Highway,<br> Blackfalds</a>
						<p><ins> $ 450,000</ins></p>
						<p>Beautiful apartment in a great, very calm and safe place.</p>
						<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img class="img-rounded" src="{{URL('assets/img/featured/property-6.jpg')}}" >
					<div class="caption text-center">
						<a href=""> 837 Sunny Embers Townline,<br> Koshkonong</a>
						<p><ins> $ 550,000</ins></p>
						<p>Beautiful apartment in a great, very calm and safe place.</p>
						<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<h3 class="text-uppercase page-header">calculator</h3>
		<form class="form container-box" role="form">
			<div class="form-group">
				<label for="">Property Price ($)</label>
				<input type="text" class="form-control input-lg">
			</div>
			<div class="form-group">
				<label for="">Percent Down</label>
				<input type="text" class="form-control input-lg">
			</div>
			<div class="form-group">
				<label for="">Term(Years)</label>
				<input type="text" class="form-control input-lg">
			</div>
			<div class="form-group">
				<label for="">Interest rate in (%)</label>
				<input type="text" class="form-control input-lg">
			</div>
			<div class="form-group">
				<a href="" class="btn btn-warning btn-block btn-lg btn-orange btn-calc">Calculate Mortgage</a>
			</div>
		</form>

		<div>
			<h3 class="text-uppercase">recently reduced</h3>
			<div class="thumbnail">
				<img src="{{URL('assets/img/recently/recently-reduced-thumbnail-1.jpg')}}" class="img-responsive pull-left" alt="">
				<a href="">046 Merry Landing, High Lonesome Wells</a>
				<p><del>$ 450,000</del> <ins> $ 350,000</ins></p>
			</div>
			<div class="thumbnail">
				<img src="{{URL('assets/img/recently/recently-reduced-thumbnail-2.jpg')}}" class="img-responsive pull-left" alt="">
				<a href="">046 Merry Landing, High Lonesome Wells</a>
				<p><del>$ 450,000</del> <ins> $ 350,000</ins></p>
			</div>
			<div class="thumbnail">
				<img src="{{URL('assets/img/recently/recently-reduced-thumbnail-3.jpg')}}" class="img-responsive pull-left" alt="">
				<a href="">837 Sunny Embers Townline</a>
				<p><del>$ 450,000</del> <ins> $ 350,000</ins></p>
			</div>
			<a href="myProperties.html" class="btn btn-primary btn-block">View more reduced properties</a>
		</div>
	</section>
</div>
</div>


<section>
	<div class="hero-section">
		<div class="container">
			<p class="lead pull-left text-uppercase">
				a great place to be Real Estate
			</p>
			<p class="hero-btn">
				<button class="btn btn-lg btn-info btn-trans pull-right">Read More</button>
				<button class="btn btn-lg btn-info btn-trans pull-right">List Property</button>
			</p>
		</div>
	</div>
	<div class="div-pattern"></div>
</section>

<div class="container">
	<h3 class="text-uppercase page-header">latest listings</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail">
				<img class="img-rounded" src="{{URL('assets/img/featured/property-7.jpg')}}" >
				<div class="caption text-center">
					<a href="">4770 Cotton Berry Point <br> Carrot River</a>
					<p><ins> $ 350,000</ins></p>
					<p>Beautiful apartment in a great, very calm and safe place.</p>
					<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="thumbnail">
				<img class="img-rounded" src="{{URL('assets/img/featured/property-8.jpg')}}" >
				<div class="caption text-center">
					<a href="">7589 Gentle City,<br> Mountain Hasty</a>
					<p><ins> $ 350,000</ins></p>
					<p>Beautiful apartment in a great, very calm and safe place.</p>
					<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="thumbnail">
				<img class="img-rounded" src="{{URL('assets/img/featured/property-9.jpg')}}" >
				<div class="caption text-center">
					<a href="">0254 Easy Oke Drive,<br> Caronport</a>
					<p><ins> $ 450,000</ins></p>
					<p>Beautiful apartment in a great, very calm and safe place.</p>
					<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="thumbnail">
				<img class="img-rounded" src="{{URL('assets/img/featured/property-10.jpg')}}" >
				<div class="caption text-center">
					<a href="">1979 Thunder Line,<br> Stoopville</a>
					<p><ins> $ 550,000</ins></p>
					<p>Beautiful apartment in a great, very calm and safe place.</p>
					<p><a href="#" class="btn btn-warning btn-orange" role="button">More Info</a></p>
				</div>
			</div>
		</div>
	</div>
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
