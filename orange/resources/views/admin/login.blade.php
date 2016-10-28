<!DOCTYPE html>
<!-- saved from url=(0058)http://coderthemes.com/ubold_2.1/menu_2/page-login-v2.html -->
<html class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
	<meta name="author" content="Coderthemes">

	<link rel="shortcut icon" href="http://coderthemes.com/ubold_2.1/menu_2/assets/images/favicon_1.ico">

	<title>BrainCommerce</title>

	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/core.css" rel="stylesheet" type="text/css">
	<link href="css/components.css" rel="stylesheet" type="text/css">
	<link href="css/icons.css" rel="stylesheet" type="text/css">
	<link href="css/pages.css" rel="stylesheet" type="text/css">
	<link href="css/responsive.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->


    </script>

</head>
<body>

	<div class="account-pages"></div>
	<div class="clearfix"></div>

	<div class="wrapper-page">
		<div class="card-box">
			<div class="panel-heading">
				<h3 class="text-center"> Sign In to <strong class="text-custom">UBold</strong></h3>
			</div>

			<div class="panel-body">
				@if(Session::has('login_error'))
				<div class="alert alert-warning">
					{{Session::get('login_error') }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</div>
				@endif
				<form class="form-horizontal m-t-20" method="post" action="{{URL('admin')}}">
					{!! csrf_field() !!}
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="text" name="email" placeholder="Email">
							@if($errors->first('email'))
							<p class="label label-danger" >
								{{ $errors->first('email') }}

							</p>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12">
							<input class="form-control" type="password" name="password" placeholder="Password">
							@if($errors->first('password'))
							<p class="label label-danger" >
								{{ $errors->first('password') }}

							</p>
							@endif
						</div>
					</div>

					<div class="form-group ">
						<div class="col-xs-12">
							<div class="checkbox checkbox-primary">
								<input id="checkbox-signup" type="checkbox">
								<label for="checkbox-signup"> Remember me </label>
							</div>

						</div>
					</div>

					<div class="form-group text-center m-t-40">
						<div class="col-xs-12">
							<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
								Log In
							</button>
						</div>
					</div>

					<div class="form-group m-t-20 m-b-0">
						<div class="col-sm-12">
							<a href="http://coderthemes.com/ubold_2.1/menu_2/page-recoverpw.html" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
						</div>
					</div>

					<div class="form-group m-t-20 m-b-0">
						<div class="col-sm-12 text-center">
							<h4><b>Sign in with</b></h4>
						</div>
					</div>

					<div class="form-group m-b-0 text-center">
						<div class="col-sm-12">
							<button type="button" class="btn btn-facebook waves-effect waves-light m-t-20">
								<i class="fa fa-facebook m-r-5"></i> Facebook
							</button>

							<button type="button" class="btn btn-twitter waves-effect waves-light m-t-20">
								<i class="fa fa-twitter m-r-5"></i> Twitter
							</button>

							<button type="button" class="btn btn-googleplus waves-effect waves-light m-t-20">
								<i class="fa fa-google-plus m-r-5"></i> Google+
							</button>
						</div>
					</div>
				</form>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-center">
				<p>
					Don't have an account? <a href="http://coderthemes.com/ubold_2.1/menu_2/page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a>
				</p>
			</div>
		</div>

	</div>

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="js/jquery.min.js.download"></script>
	<script src="js/bootstrap.min.js.download"></script>
	<script src="js/detect.js.download"></script>
	<script src="js/fastclick.js.download"></script>
	<script src="js/jquery.slimscroll.js.download"></script>
	<script src="js/jquery.blockUI.js.download"></script>
	<script src="js/waves.js.download"></script>
	<script src="js/wow.min.js.download"></script>
	<script src="js/jquery.nicescroll.js.download"></script>
	<script src="js/jquery.scrollTo.min.js.download"></script>


	<script src="js/jquery.core.js.download"></script>
	<script src="js/jquery.app.js.download"></script>


</body></html>