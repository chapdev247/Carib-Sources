@extends('templates/backend/layout')
@section('title','| Users')

@section('mainBody')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
           		<h1 class="page-header">Users</h1>
           		<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Created / Updated</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{!! $user->name !!}</td>
							<td>{{ date("d M,Y h:i",strtotime($user->created_at))." / ".date("d M,Y h:i",strtotime($user->updated_at)) }}</td>
							<td>
								@if ($user->role==1)
									{!! Html::linkroute('CmsController.getproxyLogin', '', array($user->id), array('class' => 'btn btn-primary btn-sm fa fa-lock','data-toggle' => 'tooltip','Title' => 'Login as Admin'))  !!}
								@else
									{!! Html::linkroute('CmsController.getproxyLogin', '', array($user->id), array('class' => 'btn btn-primary btn-sm fa fa-lock','data-toggle' => 'tooltip','Title' => 'Login as User','target'=>'_blank'))  !!}
								@endif
								
								@if ($user->status)
									{!! Html::linkroute('CmsController.getupdate_userstatus', '', array($user->id), array('class' => 'btn btn-success btn-sm fa fa-check-circle','data-toggle' => 'tooltip','Title' => 'Inactive'))  !!}
								@else
									{!! Html::linkroute('CmsController.getupdate_userstatus', '', array($user->id), array('class' => 'btn btn-warning btn-sm fa fa-times-circle','data-toggle' => 'tooltip','Title' => 'Active'))  !!}
								@endif
								@if ($user->role==1)
									{!! Html::linkroute('CmsController.getupdate_userrole', 'Admin', array($user->id), array('class' => 'btn btn-success btn-sm','data-toggle' => 'tooltip','Title' => 'Change To User'))  !!}
								@else
									{!! Html::linkroute('CmsController.getupdate_userrole', 'User', array($user->id), array('class' => 'btn btn-warning btn-sm','data-toggle' => 'tooltip','Title' => 'Change To Admin'))  !!}
								@endif
								
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection