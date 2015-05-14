@if ($errors->any())
	<div id="flash-alert" class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Error</h4>
		Please check the form below for errors
	</div>
@endif

@if ($message = Session::get('success'))
	<div id="flash-alert" class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Success</h4>
		{{ $message }}
	</div>
@endif

@if ($message = Session::get('error'))
	<div id="flash-alert" class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Error</h4>
		{{ $message }}
	</div>
@endif

@if ($message = Session::get('warning'))
	<div id="flash-alert" class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Warning</h4>
		{{ $message }}
	</div>
@endif

@if ($message = Session::get('info'))
	<div id="flash-alert" class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Info</h4>
		{{ $message }}
	</div>
@endif

<script>
	$('#flash-alert').delay(6000).slideUp();
</script>