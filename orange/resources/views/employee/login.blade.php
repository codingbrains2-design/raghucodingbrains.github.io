@extends('layout.employee.master')
@section('title','login')
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					Login
				</h4>
			</div>
			<div class="panel-body">
				@if(Session::has('login_error'))
				<div class="alert alert-warning">
					{{Session::get('login_error') }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</div>
				@endif
				<form action="/login" method="POST" role="form">
					{!!csrf_field()!!}
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Input field">
						@if($errors->first('email')) 
						<p class="label label-danger" >
							{{ $errors->first('email') }} 

						</p>
						@endif
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="text" class="form-control" id="password" name="password" placeholder="Input field">
						@if($errors->first('password')) 
							<p class="label label-danger" >
								{{ $errors->first('password') }} 

							</p>
							@endif
					</div>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection