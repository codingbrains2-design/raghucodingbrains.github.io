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
				<div class="card-box table-responsive">
					<h4 class="m-t-0 header-title"><b>Users</b></h4>
					<table id="datatable-responsive"
					class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
					width="100%">
					<thead>
						<tr>
							<th>User Role</th>
							<th>User Role Type</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Tiger</td>
							<td>Nixon</td>


						</tr>
						<tr>
							<td>Garrett</td>
							<td>Winters</td>

						</tr>
						<tr>
							<td>Ashton</td>
							<td>Cox</td>


						</tr>
						<tr>
							<td>Cedric</td>
							<td>Kelly</td>



						</tr>
						<tr>
							<td>Airi</td>
							<td>Satou</td>


						</tr>
						<tr>
							<td>Brielle</td>
							<td>Williamson</td>


						</tr>
						<tr>
							<td>Herrod</td>
							<td>Chandler</td>


						</tr>
						<tr>
							<td>Rhona</td>
							<td>Davidson</td>


						</tr>





					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>



</div>
<!-- end col -->

</div>
<!-- end row -->

@endsection