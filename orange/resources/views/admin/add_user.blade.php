@extends('layout.admin.admin')
@section('title') Dashboard @endsection

@section('page-body')
<div class="wrapper">
	<div class="container">

		<!-- Page-Title -->
		<div class="row">
			<div class="col-sm-12">

				<h4 class="page-title">Dashboard</h4>
				<p class="text-muted page-title-alt">Welcome to Ubold admin panel !</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<form class="form-horizontal group-border-dashed" action="#" novalidate="">
					<div class="form-group">

						<div class="col-sm-3">
							<input type="text" class="form-control" required="" placeholder=" Employee name">
						</div>
						<div class="col-sm-3">
							<input type="text" id="username" class="form-control" required="" placeholder="Username">
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-3">
							<input type="password" class="form-control" required="" data-parsley-equalto="#pass2" placeholder="Password">
						</div>
						<div class="col-sm-3">
							<input type="password" class="form-control" required="" data-parsley-equalto="#pass2" placeholder="Re-Type Password">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-3">
							<input type="text" class="form-control" required="" parsley-type="email" placeholder="ESS Role">
						</div>
						<div class="col-sm-3">
							<input data-parsley-type="digits" type="text" class="form-control" required="" placeholder="Supervisor Role">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<input parsley-type="url" type="text" class="form-control" required="" placeholder="Admin Role">
						</div>
						<div class="col-sm-3">
							<input data-parsley-type="text" type="text" class="form-control" required="" placeholder="Status">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-9 m-t-15">
							<button type="submit" class="btn btn-primary">
								Submit
							</button>
							<button type="reset" class="btn btn-default m-l-5">
								Cancel
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>


	</div>
	<!-- end col -->

</div>
<!-- end row -->

@endsection