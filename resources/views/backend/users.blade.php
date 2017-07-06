@extends('templates/backend/layout')
@section('title',$data["title"])

@section('mainBody')
	<div class="page-content-wrapper">
		<div class="page-content">
			@include('templates/backend/partials/messages')
			<h3 class="page-title">User Management<small> User List</small></h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard')}}">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						User List
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<a href="{{route('CmsController.postaddprofile')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form action="" method="get">
						<div class="col-lg-4">
							{{ Form::text('search',null, ['class'=> 'form-control','placeholder'=>'Search by Name,email','id'=>'search','autocomplete'=>'off']) }}
						</div>
						<div class="col-lg-3">
							{{ Form::select('role', [''=>'Select User Type',1=>"Subadmin",2=>"User"] , null, ['class'=>"form-control",'id'=>"role"]) }}
						</div>
						<div class="col-lg-3">
							{{ Form::select('status', [''=>'Select Status',0=>"Inactive",1=>"Active"] , null, ['class'=>"form-control",'id'=>"status"]) }}
						</div>
						<div class="col-lg-2 inline">
							<button type="submit" class="btn btn-primary" data-toggle="tooltip" data-title="Search"><i class="fa fa-search"></i></button>
							<a href="{{route('CmsController.getusers')}}" class="btn btn-danger" data-toggle="tooltip" data-title="Reset"><i class="fa fa-close"></i></a> 
						</div>
					</form>
				</div>
	            <div class="col-lg-12">
	           		<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Created / Updated</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@if(count($data["users"])>0)
								@foreach ($data["users"] as $index => $user)
								<tr>
									<td>{{ (($data['users']->currentPage()-1)*$data['users']->perPage())+($index+1) }}</td>
									<td>{!! $user->f_name." ".$user->l_name !!}</td>
									<td>{!! $user->email !!}</td>
									<td>{{ date("d M,Y h:i",strtotime($user->created_at))." / ".date("d M,Y h:i",strtotime($user->updated_at)) }}</td>
									<td>
										{!! Html::linkroute('CmsController.getproxyLogin', '', array($user->id), array('class' => 'btn btn-success btn-sm fa fa-lock','data-toggle' => 'tooltip','Title' => 'Login as User','target' => '_blank'))  !!}
										{{-- $user->role==1?'Login as Subadmin': --}}
										{!! Html::linkroute('CmsController.getprofile', '', array($user->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil','data-toggle' => 'tooltip','Title' => $user->role==1?'Edit Subadmin':'Edit User'))  !!}
										{!! Html::linkroute('CmsController.getupdate_userstatus', '', array($user->id), array('class' => 'btn btn-sm '.($user->status?'btn-success fa fa-check-circle':'btn-danger fa fa-times-circle'),'data-toggle' => 'tooltip','Title' => 'Inactive','onclick'=>"return confirm('Are you sure you want to change status?')"))  !!}
										{!! Html::linkroute('CmsController.getupdate_userrole', '', array($user->id), array('class' => 'btn btn-sm icon-user'.($user->role==1?' btn-success':' btn-warning'),'data-toggle' => 'tooltip','Title' => $user->role==1?'Update as user':'Update as Subadmin','onclick'=>"return confirm('Are you sure you want to update status?')"))  !!}
									</td>
								</tr>
								@endforeach
							@else
								<tr>
									<td colspan="5"><strong><center>No Users Found</center></strong></td>
								</tr>
							@endif
						</tbody>
					</table>
					<div>
                        {{ $data["users"]->appends($_GET)->links() }}
                    </div>
	            </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection