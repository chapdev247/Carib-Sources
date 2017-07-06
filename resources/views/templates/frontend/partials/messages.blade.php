@if (Session::has('success_msg'))
	<div class="alert alert-success">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('success_msg')}}
	</div>
@endif
@if (Session::has('warning_msg'))
	<div class="alert alert-warning">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('warning_msg')}}
	</div>
@endif
@if (Session::has('error_msg'))
	<div class="alert alert-danger">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('error_msg')}}
	</div>
@endif