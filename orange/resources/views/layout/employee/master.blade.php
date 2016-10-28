<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HRM - @yield('title')</title>
	@include('layout.employee.header')
</head>
<body>
	<div class="wrapper">

		@yield('content')
	</div>

	@include('layout.employee.footer')
</body>
</html>

