{!! Html::script('js/jquery.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}

<!--   Core JS Files   -->
{!! Html::script("assets/js/jquery-1.10.2.js") !!}
{!! Html::script("assets/js/bootstrap.min.js") !!}

<!--  Checkbox, Radio & Switch Plugins -->
{!! Html::script("assets/js/bootstrap-checkbox-radio-switch.js") !!}

<!--  Charts Plugin -->
{!! Html::script("assets/js/chartist.min.js") !!}

<!--  Notifications Plugin    -->
{!! Html::script("assets/js/bootstrap-notify.js") !!}

<!--  Google Maps Plugin    -->
{!! Html::script("https://maps.googleapis.com/maps/api/js?sensor=false") !!}

{!! Html::script("assets/js/light-bootstrap-dashboard.js") !!}

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
{!! Html::script("assets/js/demo.js") !!}

<script>
	$().ready(function(){
		demo.initGoogleMaps();
	});
</script>
<script>

	$('#leave').on('click',function(){
		$('#leave_sub').toggle();
	})


</script>
