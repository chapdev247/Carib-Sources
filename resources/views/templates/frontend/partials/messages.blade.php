@if (Session::has('success_msg'))

	<div class="alert alert-success">
  		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Succcess :</strong> {{ Session::get('success_msg')}}
	</div>
@endif