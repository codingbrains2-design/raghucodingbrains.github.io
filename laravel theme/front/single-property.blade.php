@extends('layouts.front.master')
@section('title', 'Page Title')
@section('content')
<div class="container">
	<div class="col-md-9">
		<div id="carousel-id" class="carousel slide" data-ride="carousel" style="margin-top:0px;">
			<div class="carousel-inner">
				<div class="item active">
					<img src="{{URL('assets/img/gallery/gallery-1.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
				<div class="item">
					<img src="{{URL('assets/img/gallery/gallery-2.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
				<div class="item">
					<img src="{{URL('assets/img/gallery/gallery-3.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
				<div class="item">
					<img src="{{URL('assets/img/gallery/gallery-4.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
				<div class="item">
					<img src="{{URL('assets/img/gallery/gallery-5.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
				<div class="item">
					<img src="{{URL('assets/img/gallery/gallery-6.jpg')}}" class="img-responsive" alt="gallery-image">
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-id" data-slide="prev">&lsaquo;</a>
			<a class="right carousel-control" href="#carousel-id" data-slide="next">&rsaquo;</a>
		</div>
		<div class="row">
			<div class="col-md-4 table-responsive">
				<h3>SUMMERY</h3>
				<table class="table table-hover">
					<tr>
						<td>Price</td>
						<td><span class="label label-success">$ 1 450 000</span></td>
					</tr>
					<tr>
						<td>Area</td>
						<td>185 m2</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>Sale</td>
					</tr>
					<tr>
						<td>Type</td>
						<td>House</td>
					</tr>
					<tr>
						<td>Location</td>
						<td>Chinhat</td>
					</tr>
					<tr>
						<td>Beds</td>
						<td>4</td>
					</tr>
					<tr>
						<td>Baths</td>
						<td>2</td>
					</tr>
					<tr>
						<td>Garage</td>
						<td>1</td>
					</tr>
					<tr>
						<td>Pool</td>
						<td>Yes</td>
					</tr>
				</table>
			</div>
			<div class="col-md-8">
				<h3>DESCRIPTION</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum nulla vel.Lorem ipsum dolor sit amet, consectetur adipiscing elit.Estato was designed to become your real estate business partner. It’s not only a tool, it’s a working ecosystem. With our design and structures you will be able to show your property in better light. Thanks to our content optimization you will get more visits to your property page.</p>
				<h3>PROPERTY DETAILS</h3>
				<div class="table-responsive">
					<table id="propertyTable" class="table table-hover table-striped">
						<tr>
							<td><label class="label label-success">&#10004;</label> Air Conditioning</td>
							<td><label class="label label-success">&#10004;</label> Full HD TV</td>
						</tr>
						<tr>
							<td><label class="label label-success">&#10004;</label> ADSL Cable</td>
							<td><label class="label label-danger">&#x2717;</label> Digital Antenna</td>
						</tr>
						<tr>
							<td><label class="label label-success">&#10004;</label> WiFi</td>
							<td><label class="label label-success">&#10004;</label> Kitchen with Island</td>
						</tr>
						<tr>
							<td><label class="label label-danger">&#x2717;</label> HiFi Audio</td>
							<td><label class="label label-danger">&#x2717;</label> Exotic Garden</td>
						</tr>
						<tr>
							<td><label class="label label-success">&#10004;</label> Fridge</td>
							<td><label class="label label-danger">&#x2717;</label> Guest House</td>
						</tr>
						<tr>
							<td><label class="label label-success">&#10004;</label> Grill</td>
						</tr>
					</table>
				</div>
				<h3>MAP</h3>
				<div id="map-box">
					
				</div>
			</div>
		</div>
		<br><br>
	</div>
	<div class="col-md-3">
		<form class="form container-box" role="form">
			<div id="searchPropertyBtn" class="input-group text-center">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">
						<i class="fa fa-search"></i>
					</button> 
					<button type="submit" class="btn btn-primary text-uppercase">calculate loan</button>  
				</span>
			</div>
			<div class="form-group">
				<label for="">Property Price ($)</label>
				<input type="text" class="form-control input-lg" required>
			</div>
			<div class="form-group">
				<label for="">Percent Down</label>
				<input type="text" class="form-control input-lg" required>
			</div>
			<div class="form-group">
				<label for="">Term(Years)</label>
				<input type="text" class="form-control input-lg" required>
			</div>
			<div class="form-group">
				<label for="">Interest rate in (%)</label>
				<input type="text" class="form-control input-lg" required>
			</div>
			<div class="form-group">
				<a href="" class="btn btn-warning btn-block btn-lg btn-orange btn-calc">Calculate Mortgage</a>
			</div>
		</form>
		<div>
			<h3 class="text-uppercase">contact agent</h3>
			<div class="thumbnail">
				<img src="{{URL('assets/img/agents/agent-single.jpg')}}">
				<div class="caption">
					<h3>Steven Smith</h3>
					<a href="">55 Properties</a>
					<hr>
					<p><i class="fa fa-phone"> +91 8563 902 302</i></p>
					<p><i class="fa fa-mobile"> +91 8800 123 4562</i></p>
					<p><i class="fa fa-skype"> <a href="">lotusgt1</a></i></p>
					<hr>
					<form class="form" role="form">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Name" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Phone" required>
						</div>
						<div class="form-group">
							<textarea name="" id="" class="form-control" cols="30" rows="3" placeholder="Message" required></textarea>
						</div>
						<div class="form-group">
							<a href="" class="btn btn-warning btn-block btn-lg btn-orange">Send Message</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<h3 class="text-uppercase page-header">similar listings</h3>
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
	@endsection