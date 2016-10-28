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
			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box fadeInDown animated">
					<div class="bg-icon bg-icon-info pull-left">
						<i class="md md-attach-money text-info"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter">31,570</b></h3>
						<p class="text-muted">Total Revenue</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-pink pull-left">
						<i class="md md-add-shopping-cart text-pink"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter">280</b></h3>
						<p class="text-muted">Today's Sales</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-purple pull-left">
						<i class="md md-equalizer text-purple"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter">0.16</b>%</h3>
						<p class="text-muted">Conversion</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>

			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-success pull-left">
						<i class="md md-remove-red-eye text-success"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter">64,570</b></h3>
						<p class="text-muted">Today's Visits</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-lg-4">
				<div class="card-box">
					<h4 class="text-dark header-title m-t-0 m-b-30">Total Revenue</h4>

					<div class="widget-chart text-center">
						<div style="display:inline;width:150px;height:150px;"><canvas width="150" height="150"></canvas><input class="knob" data-width="150" data-height="150" data-linecap="round" data-fgcolor="#fb6d9d" value="80" data-skin="tron" data-angleoffset="180" data-readonly="true" data-thickness=".15" readonly="readonly" style="width: 79px; height: 50px; position: absolute; vertical-align: middle; margin-top: 50px; margin-left: -114px; border: 0px; background: none; font-style: normal; font-variant: normal; font-weight: bold; font-stretch: normal; font-size: 30px; line-height: normal; font-family: Arial; text-align: center; color: rgb(251, 109, 157); padding: 0px; -webkit-appearance: none;"></div>
						<h5 class="text-muted m-t-20">Total sales made today</h5>
						<h2 class="font-600">$75</h2>
						<ul class="list-inline m-t-15">
							<li>
								<h5 class="text-muted m-t-20">Target</h5>
								<h4 class="m-b-0">$1000</h4>
							</li>
							<li>
								<h5 class="text-muted m-t-20">Last week</h5>
								<h4 class="m-b-0">$523</h4>
							</li>
							<li>
								<h5 class="text-muted m-t-20">Last Month</h5>
								<h4 class="m-b-0">$965</h4>
							</li>
						</ul>
					</div>
				</div>

			</div>

			<div class="col-lg-8">
				<div class="card-box">
					<h4 class="text-dark header-title m-t-0">Sales Analytics</h4>
					<div class="text-center">
						<ul class="list-inline chart-detail-list">
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>Desktops</h5>
							</li>
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Tablets</h5>
							</li>
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #dcdcdc;"></i>Mobiles</h5>
							</li>
						</ul>
					</div>
					<div id="morris-bar-stacked" style="height: 303px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="303" version="1.1" width="741" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.8125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="33.5" y="264" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#eeeeee" d="M46,264H716" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="204.25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text><path fill="none" stroke="#eeeeee" d="M46,204.25H716" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="144.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">200</tspan></text><path fill="none" stroke="#eeeeee" d="M46,144.5H716" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="84.75" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">300</tspan></text><path fill="none" stroke="#eeeeee" d="M46,84.75H716" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">400</tspan></text><path fill="none" stroke="#eeeeee" d="M46,25H716" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="685.5454545454545" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="563.7272727272727" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="441.90909090909093" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="320.09090909090907" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><text x="198.27272727272728" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan></text><text x="76.45454545454545" y="276.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2005</tspan></text><rect x="53.61363636363636" y="237.1125" width="45.68181818181818" height="26.88749999999999" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="53.61363636363636" y="129.5625" width="45.68181818181818" height="107.55000000000001" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="53.61363636363636" y="69.8125" width="45.68181818181818" height="59.75" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="114.52272727272727" y="219.1875" width="45.68181818181818" height="44.8125" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="114.52272727272727" y="180.35" width="45.68181818181818" height="38.837500000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="114.52272727272727" y="132.54999999999998" width="45.68181818181818" height="47.80000000000001" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="175.4318181818182" y="204.25" width="45.68181818181818" height="59.75" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="175.4318181818182" y="150.475" width="45.68181818181818" height="53.775000000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="175.4318181818182" y="117.01499999999999" width="45.68181818181818" height="33.46000000000001" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="236.3409090909091" y="219.1875" width="45.68181818181818" height="44.8125" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="236.3409090909091" y="180.35" width="45.68181818181818" height="38.837500000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="236.3409090909091" y="127.17249999999999" width="45.68181818181818" height="53.17750000000001" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="297.25" y="204.25" width="45.68181818181818" height="59.75" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="297.25" y="150.475" width="45.68181818181818" height="53.775000000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="297.25" y="78.775" width="45.68181818181818" height="71.69999999999999" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="358.1590909090909" y="219.1875" width="45.68181818181818" height="44.8125" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="358.1590909090909" y="180.35" width="45.68181818181818" height="38.837500000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="358.1590909090909" y="114.62499999999997" width="45.68181818181818" height="65.72500000000002" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="419.0681818181818" y="234.125" width="45.68181818181818" height="29.875" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="419.0681818181818" y="210.225" width="45.68181818181818" height="23.900000000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="419.0681818181818" y="159.4375" width="45.68181818181818" height="50.787499999999994" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="479.97727272727275" y="219.1875" width="45.68181818181818" height="44.8125" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="479.97727272727275" y="180.35" width="45.68181818181818" height="38.837500000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="479.97727272727275" y="149.28" width="45.68181818181818" height="31.069999999999993" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="540.8863636363636" y="234.125" width="45.68181818181818" height="29.875" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="540.8863636363636" y="210.225" width="45.68181818181818" height="23.900000000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="540.8863636363636" y="164.2175" width="45.68181818181818" height="46.00749999999999" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="601.7954545454545" y="219.1875" width="45.68181818181818" height="44.8125" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="601.7954545454545" y="180.35" width="45.68181818181818" height="38.837500000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="601.7954545454545" y="126.57499999999999" width="45.68181818181818" height="53.775000000000006" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="662.7045454545454" y="204.25" width="45.68181818181818" height="59.75" rx="0" ry="0" fill="#5fbeaa" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="662.7045454545454" y="150.475" width="45.68181818181818" height="53.775000000000006" rx="0" ry="0" fill="#5d9cec" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="662.7045454545454" y="72.79999999999998" width="45.68181818181818" height="77.67500000000001" rx="0" ry="0" fill="#ebeff2" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect></svg><div class="morris-hover morris-default-style" style="display: none;"></div></div>
				</div>
			</div>



		</div>
		<!-- end row -->


		<div class="row">

			<div class="col-lg-6">
				<div class="card-box">
					<h4 class="text-dark header-title m-t-0">Total Sales</h4>

					<div class="text-center">
						<ul class="list-inline chart-detail-list">
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #5fbeaa;"></i>Desktops</h5>
							</li>
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i>Tablets</h5>
							</li>
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #ebeff2;"></i>Mobiles</h5>
							</li>
						</ul>
					</div>

					<div id="morris-area-with-dotted" style="height: 300px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><svg height="300" version="1.1" width="540" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.453125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.2</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="33.5" y="261" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#eef0f2" d="M46,261H515" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="202" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan></text><path fill="none" stroke="#eef0f2" d="M46,202H515" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="143" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text><path fill="none" stroke="#eef0f2" d="M46,143H515" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="84" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">150</tspan></text><path fill="none" stroke="#eef0f2" d="M46,84H515" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">200</tspan></text><path fill="none" stroke="#eef0f2" d="M46,25H515" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="515" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2015</tspan></text><text x="436.8690095846645" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014</tspan></text><text x="358.73801916932905" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan></text><text x="280.39297124600637" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2012</tspan></text><text x="202.26198083067092" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="124.13099041533546" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><text x="46" y="273.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><path fill="#f9fafa" stroke="none" d="M46,190.2C65.53274760383387,157.75,104.59824281150159,69.25,124.13099041533546,60.400000000000006C143.66373801916933,51.55000000000001,182.72923322683707,119.4,202.26198083067092,119.4C221.79472843450478,119.4,260.8602236421725,60.400000000000006,280.39297124600637,60.400000000000006C299.97923322683704,60.400000000000006,339.1517571884984,119.4,358.73801916932905,119.4C378.2707667731629,119.4,417.33626198083067,69.25,436.8690095846645,60.400000000000006C456.4017571884984,51.55000000000001,495.46725239616615,51.55000000000002,515,48.60000000000002L515,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#ebeff2" d="M46,190.2C65.53274760383387,157.75,104.59824281150159,69.25,124.13099041533546,60.400000000000006C143.66373801916933,51.55000000000001,182.72923322683707,119.4,202.26198083067092,119.4C221.79472843450478,119.4,260.8602236421725,60.400000000000006,280.39297124600637,60.400000000000006C299.97923322683704,60.400000000000006,339.1517571884984,119.4,358.73801916932905,119.4C378.2707667731629,119.4,417.33626198083067,69.25,436.8690095846645,60.400000000000006C456.4017571884984,51.55000000000001,495.46725239616615,51.55000000000002,515,48.60000000000002" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="190.2" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="124.13099041533546" cy="60.400000000000006" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="202.26198083067092" cy="119.4" r="3" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="280.39297124600637" cy="60.400000000000006" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="358.73801916932905" cy="119.4" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="436.8690095846645" cy="60.400000000000006" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="515" cy="48.60000000000002" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#b0caea" stroke="none" d="M46,225.6C65.53274760383387,193.15,104.59824281150159,104.65,124.13099041533546,95.80000000000001C143.66373801916933,86.95000000000002,182.72923322683707,154.8,202.26198083067092,154.8C221.79472843450478,154.8,260.8602236421725,95.80000000000001,280.39297124600637,95.80000000000001C299.97923322683704,95.80000000000001,339.1517571884984,154.8,358.73801916932905,154.8C378.2707667731629,154.8,417.33626198083067,104.65,436.8690095846645,95.80000000000001C456.4017571884984,86.95000000000002,495.46725239616615,86.95,515,84L515,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#5d9cec" d="M46,225.6C65.53274760383387,193.15,104.59824281150159,104.65,124.13099041533546,95.80000000000001C143.66373801916933,86.95000000000002,182.72923322683707,154.8,202.26198083067092,154.8C221.79472843450478,154.8,260.8602236421725,95.80000000000001,280.39297124600637,95.80000000000001C299.97923322683704,95.80000000000001,339.1517571884984,154.8,358.73801916932905,154.8C378.2707667731629,154.8,417.33626198083067,104.65,436.8690095846645,95.80000000000001C456.4017571884984,86.95000000000002,495.46725239616615,86.95,515,84" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="225.6" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="124.13099041533546" cy="95.80000000000001" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="202.26198083067092" cy="154.8" r="3" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="280.39297124600637" cy="95.80000000000001" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="358.73801916932905" cy="154.8" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="436.8690095846645" cy="95.80000000000001" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="515" cy="84" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><path fill="#99cac0" stroke="none" d="M46,249.2C65.53274760383387,230.02499999999998,104.59824281150159,178.4,124.13099041533546,172.5C143.66373801916933,166.6,182.72923322683707,202,202.26198083067092,202C221.79472843450478,202,260.8602236421725,172.5,280.39297124600637,172.5C299.97923322683704,172.5,339.1517571884984,202,358.73801916932905,202C378.2707667731629,202,417.33626198083067,178.4,436.8690095846645,172.5C456.4017571884984,166.6,495.46725239616615,159.22500000000002,515,154.8L515,261L46,261Z" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></path><path fill="none" stroke="#5fbeaa" d="M46,249.2C65.53274760383387,230.02499999999998,104.59824281150159,178.4,124.13099041533546,172.5C143.66373801916933,166.6,182.72923322683707,202,202.26198083067092,202C221.79472843450478,202,260.8602236421725,172.5,280.39297124600637,172.5C299.97923322683704,172.5,339.1517571884984,202,358.73801916932905,202C378.2707667731629,202,417.33626198083067,178.4,436.8690095846645,172.5C456.4017571884984,166.6,495.46725239616615,159.22500000000002,515,154.8" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="46" cy="249.2" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="124.13099041533546" cy="172.5" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="202.26198083067092" cy="202" r="3" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="280.39297124600637" cy="172.5" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="358.73801916932905" cy="202" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="436.8690095846645" cy="172.5" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="515" cy="154.8" r="0" fill="#ffffff" stroke="#999999" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 153.262px; top: 94px;"><div class="morris-hover-row-label">2011</div><div class="morris-hover-point" style="color: #5fbeaa">
					Desktops :
					50
				</div><div class="morris-hover-point" style="color: #5d9cec">
				Tablets :
				40
			</div><div class="morris-hover-point" style="color: #ebeff2">
			Mobiles :
			30
		</div></div></div>

	</div>

</div>

<!-- col -->

<div class="col-lg-6">
	<div class="card-box">
		<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="pull-right btn btn-default btn-sm waves-effect waves-light">View All</a>
		<h4 class="text-dark header-title m-t-0">Recent Orders</h4>
		<p class="text-muted m-b-30 font-13">
			Use the button classes on an element.
		</p>

		<div class="table-responsive">
			<table class="table table-actions-bar m-b-0">
				<thead>
					<tr>
						<th></th>
						<th>Item Name</th>
						<th>Up-Down</th>
						<th style="min-width: 80px;">Manage</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><span data-plugin="peity-bar" data-colors="#5fbeaa,#5fbeaa" data-width="80" data-height="30" style="display: none;">5,3,9,6,5,9,7,3,5,2</span><svg class="peity" height="30" width="80"><rect fill="#5fbeaa" x="0.8" y="13.333333333333332" width="6.4" height="16.666666666666668"></rect><rect fill="#5fbeaa" x="8.8" y="20" width="6.399999999999999" height="10"></rect><rect fill="#5fbeaa" x="16.8" y="0" width="6.399999999999999" height="30"></rect><rect fill="#5fbeaa" x="24.8" y="10" width="6.399999999999999" height="20"></rect><rect fill="#5fbeaa" x="32.8" y="13.333333333333332" width="6.400000000000006" height="16.666666666666668"></rect><rect fill="#5fbeaa" x="40.8" y="0" width="6.400000000000006" height="30"></rect><rect fill="#5fbeaa" x="48.8" y="6.666666666666668" width="6.400000000000006" height="23.333333333333332"></rect><rect fill="#5fbeaa" x="56.8" y="20" width="6.400000000000006" height="10"></rect><rect fill="#5fbeaa" x="64.8" y="13.333333333333332" width="6.400000000000006" height="16.666666666666668"></rect><rect fill="#5fbeaa" x="72.8" y="23.333333333333336" width="6.400000000000006" height="6.666666666666664"></rect></svg></td>
						<td><img src="./Ubold - Responsive Admin Dashboard Template_files/iphone.jpg" class="thumb-sm pull-left m-r-10" alt=""> Apple iPhone </td>
						<td><span class="text-custom">+$230</span></td>
						<td>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-edit"></i></a>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-close"></i></a>
						</td>
					</tr>

					<tr>
						<td><span data-plugin="peity-line" data-fill="#5fbeaa" data-stroke="#5fbeaa" data-width="80" data-height="30" style="display: none;">0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span><svg class="peity" height="30" width="80"><polygon fill="#5fbeaa" points="0 0.5 0 0.5 8.88888888888889 12.92857142857143 17.77777777777778 25.357142857142858 26.666666666666668 17.071428571428573 35.55555555555556 21.214285714285715 44.44444444444444 17.071428571428573 53.333333333333336 29.5 62.22222222222223 12.92857142857143 71.11111111111111 21.214285714285715 80 8.785714285714285 80 0.5"></polygon><polyline fill="none" points="0 0.5 8.88888888888889 12.92857142857143 17.77777777777778 25.357142857142858 26.666666666666668 17.071428571428573 35.55555555555556 21.214285714285715 44.44444444444444 17.071428571428573 53.333333333333336 29.5 62.22222222222223 12.92857142857143 71.11111111111111 21.214285714285715 80 8.785714285714285" stroke="#5fbeaa" stroke-width="1" stroke-linecap="square"></polyline></svg></td>
						<td><img src="./Ubold - Responsive Admin Dashboard Template_files/samsung.jpg" class="thumb-sm pull-left m-r-10" alt=""> Samsung Phone </td>
						<td><span class="text-danger">-$154</span></td>
						<td>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-edit"></i></a>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-close"></i></a>
						</td>
					</tr>

					<tr>
						<td><span data-plugin="peity-line" data-fill="#fff" data-stroke="#5fbeaa" data-width="80" data-height="30" style="display: none;">5,3,9,6,5,9,7,3,5,2</span><svg class="peity" height="30" width="80"><polygon fill="#fff" points="0 29.5 0 13.38888888888889 8.88888888888889 19.833333333333336 17.77777777777778 0.5 26.666666666666668 10.166666666666668 35.55555555555556 13.38888888888889 44.44444444444444 0.5 53.333333333333336 6.944444444444443 62.22222222222223 19.833333333333336 71.11111111111111 13.38888888888889 80 23.055555555555557 80 29.5"></polygon><polyline fill="none" points="0 13.38888888888889 8.88888888888889 19.833333333333336 17.77777777777778 0.5 26.666666666666668 10.166666666666668 35.55555555555556 13.38888888888889 44.44444444444444 0.5 53.333333333333336 6.944444444444443 62.22222222222223 19.833333333333336 71.11111111111111 13.38888888888889 80 23.055555555555557" stroke="#5fbeaa" stroke-width="1" stroke-linecap="square"></polyline></svg>
						</td><td><img src="./Ubold - Responsive Admin Dashboard Template_files/imac.jpg" class="thumb-sm pull-left m-r-10" alt=""> Apple iPhone </td>
						<td><span class="text-custom">+$1850</span></td>
						<td>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-edit"></i></a>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-close"></i></a>
						</td>
					</tr>

					<tr>
						<td><span data-plugin="peity-pie" data-colors="#5fbeaa,#ebeff2" data-width="30" data-height="30" style="display: none;">1/5</span><svg class="peity" height="30" width="30"><path d="M 15.000000000000002 0 A 15 15 0 0 1 29.265847744427305 10.36474508437579 L 15 15" fill="#5fbeaa"></path><path d="M 29.265847744427305 10.36474508437579 A 15 15 0 1 1 14.999999999999996 0 L 15 15" fill="#ebeff2"></path></svg></td>
						<td><img src="./Ubold - Responsive Admin Dashboard Template_files/macbook.jpg" class="thumb-sm pull-left m-r-10" alt=""> Apple iPhone </td>
						<td><span class="text-danger">-$560</span></td>
						<td>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-edit"></i></a>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-close"></i></a>
						</td>
					</tr>

					<tr>
						<td><span data-plugin="peity-bar" data-colors="#5fbeaa,#ebeff2" data-width="80" data-height="30" style="display: none;">5,3,9,6,5,9,7,3,5,2</span><svg class="peity" height="30" width="80"><rect fill="#5fbeaa" x="0.8" y="13.333333333333332" width="6.4" height="16.666666666666668"></rect><rect fill="#ebeff2" x="8.8" y="20" width="6.399999999999999" height="10"></rect><rect fill="#5fbeaa" x="16.8" y="0" width="6.399999999999999" height="30"></rect><rect fill="#ebeff2" x="24.8" y="10" width="6.399999999999999" height="20"></rect><rect fill="#5fbeaa" x="32.8" y="13.333333333333332" width="6.400000000000006" height="16.666666666666668"></rect><rect fill="#ebeff2" x="40.8" y="0" width="6.400000000000006" height="30"></rect><rect fill="#5fbeaa" x="48.8" y="6.666666666666668" width="6.400000000000006" height="23.333333333333332"></rect><rect fill="#ebeff2" x="56.8" y="20" width="6.400000000000006" height="10"></rect><rect fill="#5fbeaa" x="64.8" y="13.333333333333332" width="6.400000000000006" height="16.666666666666668"></rect><rect fill="#ebeff2" x="72.8" y="23.333333333333336" width="6.400000000000006" height="6.666666666666664"></rect></svg></td>
						<td><img src="./Ubold - Responsive Admin Dashboard Template_files/lumia.jpg" class="thumb-sm pull-left m-r-10" alt=""> Lumia iPhone </td>
						<td><span class="text-custom">+$230</span></td>
						<td>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-edit"></i></a>
							<a href="http://coderthemes.com/ubold_2.1/menu_2/index.html#" class="table-action-btn"><i class="md md-close"></i></a>
						</td>
					</tr>

				</tbody>
			</table>
		</div>

	</div>
</div>
<!-- end col -->

</div>
<!-- end row -->

@endsection