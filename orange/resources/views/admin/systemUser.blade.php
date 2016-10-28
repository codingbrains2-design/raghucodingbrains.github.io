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
				<div class="table-responsive">
					<table class="table table-hover mails m-0 table table-actions-bar">
						<thead>
							<tr>
								<th style="min-width: 95px;">
									<div class="checkbox checkbox-primary checkbox-single m-r-15">
										<input id="action-checkbox" type="checkbox">
										<label for="action-checkbox"></label>
									</div>
									<div class="btn-group dropdown">
										<button type="button" class="btn btn-white btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
										<ul class="dropdown-menu" role="menu">
											<li><a href="#">Action</a></li>
											<li><a href="#">Another action</a></li>
											<li><a href="#">Something else here</a></li>
											<li class="divider"></li>
											<li><a href="#">Separated link</a></li>
										</ul>
									</div>
								</th>
								<th>Name</th>
								<th>Email</th>
								<th>Products</th>
								<th>Start Date</th>
								<th style="min-width: 90px;">Action</th>
							</tr>
						</thead>

						<tbody>
							<tr class="active">
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox2" type="checkbox" checked="">
										<label for="checkbox2"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Tomaslau
								</td>

								<td>
									<a href="#">tomaslau@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>356</b></a> </b>
								</td>

								<td>
									01/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox1" type="checkbox">
										<label for="checkbox1"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Chadengle
								</td>

								<td>
									<a href="#">chadengle@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>568</b></a> </b>
								</td>

								<td>
									01/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox3" type="checkbox">
										<label for="checkbox3"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Stillnotdavid
								</td>

								<td>
									<a href="#">stillnotdavid@dummy.com</a>
								</td>
								<td>
									<b><a href="" class="text-dark"><b>201</b></a> </b>
								</td>

								<td>
									12/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox4" type="checkbox">
										<label for="checkbox4"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Kurafire
								</td>

								<td>
									<a href="#">kurafire@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>56</b></a> </b>
								</td>

								<td>
									14/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox5" type="checkbox">
										<label for="checkbox5"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Shahedk
								</td>

								<td>
									<a href="#">shahedk@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>356</b></a> </b>
								</td>

								<td>
									20/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox6" type="checkbox">
										<label for="checkbox6"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Adhamdannaway
								</td>

								<td>
									<a href="#">adhamdannaway@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>956</b></a> </b>
								</td>

								<td>
									24/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox7" type="checkbox">
										<label for="checkbox7"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Ok
								</td>

								<td>
									<a href="#">nicename@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>852</b></a> </b>
								</td>

								<td>
									29/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox8" type="checkbox">
										<label for="checkbox8"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Arashasghari
								</td>

								<td>
									<a href="#">arashasghari@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>201</b></a> </b>
								</td>

								<td>
									01/12/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox9" type="checkbox">
										<label for="checkbox9"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Joshaustin
								</td>

								<td>
									<a href="#">joshaustin@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>421</b></a> </b>
								</td>

								<td>
									09/12/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox10" type="checkbox">
										<label for="checkbox10"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Sortino
								</td>

								<td>
									<a href="#">sortino@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>41</b></a> </b>
								</td>

								<td>
									10/12/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox12" type="checkbox">
										<label for="checkbox12"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Tomaslau
								</td>

								<td>
									<a href="#">tomaslau@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>231</b></a> </b>
								</td>

								<td>
									01/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox11" type="checkbox">
										<label for="checkbox11"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Chadengle
								</td>

								<td>
									<a href="#">chadengle@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>785</b></a> </b>
								</td>

								<td>
									01/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox13" type="checkbox">
										<label for="checkbox13"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Stillnotdavid
								</td>

								<td>
									<a href="#">stillnotdavid@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>52</b></a> </b>
								</td>

								<td>
									12/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>

							<tr>
								<td>
									<div class="checkbox checkbox-primary m-r-15">
										<input id="checkbox14" type="checkbox">
										<label for="checkbox14"></label>
									</div>

									<img src="/images/me.jpg" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
								</td>

								<td>
									Kurafire
								</td>

								<td>
									<a href="#">kurafire@dummy.com</a>
								</td>

								<td>
									<b><a href="" class="text-dark"><b>352</b></a> </b>
								</td>

								<td>
									14/11/2003
								</td>
								<td>
									<a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
									<a href="#" class="table-action-btn"><i class="md md-close"></i></a>
								</td>
							</tr>


						</tbody>
					</table>
				</div>



			</div>
			<!-- end col -->

		</div>
		<!-- end row -->

		@endsection