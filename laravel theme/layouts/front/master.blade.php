<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>RealEstate | @yield('title')</title>
	<link rel="icon" type="image/png" href="{{ URL('assets/images/october.png') }}">
	{!! Html::style('assets/css/bootstrap.min.css') !!}
	{!! Html::style('assets/css/realestate.css') !!}
	{!! Html::style('assets/css/font-awesome.min.css') !!}
</head>
<body>
	<div id="wrapper">
		<header id="layout-header">
			@include('layouts.front.header')
		</header>
		<section id="layout-content">
			@yield('content')
		</section>
		<footer id="layout-footer">
			@include('layouts.front.footer')
		</footer>
		
		{!! Html::script('assets/js/jquery-1.10.1.min.js') !!}
		{!! Html::script('assets/js/bootstrap.min.js') !!}
	</body>
	</html>