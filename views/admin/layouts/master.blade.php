<!DOCTYPE HTML>
<html>
<head>
	<title>Shoppy an Admin Panel Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<title>App Name - @yield('title')</title>
	@include('admin.layouts.header')
</head>


<body>
	<div class="page-container">
		@include('admin.layouts.sidebar')
		@yield('content')
	</div>
	@include('admin.layouts.footer')
</body>
</html>