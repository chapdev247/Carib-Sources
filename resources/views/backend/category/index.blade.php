@extends('templates/backend/layout')

@section('title',$data['title'])

@section('mainBody')
	<div class="page-content-wrapper">
		<div class="page-content">
			@include('templates/backend/partials/messages')
			<h3 class="page-title">Category Management<small> Category List</small></h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard')}}">Dashboard</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						Category List
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form action="" method="get">
						<div class="col-lg-3" style="width: 21%;">
							{{ Form::text('search',null, ['class'=> 'form-control','placeholder'=>'Search by Name,slug','id'=>'search','autofocus'=>'on']) }}
						</div>
						<div class="col-lg-3" style="width: 21%;">
							{{ Form::select('parent', $data['cat_select'] , null, ['class'=>"form-control",'id'=>"root"]) }}
						</div>
						<div class="col-lg-3" style="width: 21%;">
							{{ Form::select('root', [0=>'Select Category type',1=>"Root categories",2=>"Sub categories"] , null, ['class'=>"form-control",'id'=>"root"]) }}
						</div>
						<div class="col-lg-2">
                            {{ Form::select('status', [""=>'Select Status?',0=>"Inactive",1=>"Active"] , null, ['class'=>"form-control",'id'=>"status"]) }}
                        </div>
						<div class="col-lg-2 inline">
							<button type="submit" class="btn btn-primary"><i class="fa fa-search" data-toggle="tooltip" data-title="Search"></i></button>
							<a href="{{route('categories.index')}}" class="btn btn-danger" data-toggle="tooltip" data-title="Reset"><i class="fa fa-close"></i></a> 
						</div>
					</form>
				</div>
	            <div class="col-lg-12">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Slug</th>
								<th>Parent</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@if (count($data['categories'])>0)
								@foreach ($data['categories'] as $index => $category)
								<tr>
									<td>{{ (($data['categories']->currentPage()-1)*$data['categories']->perPage())+($index+1) }}</td>
									<td>{{ $category->name }}</td>
									<td>{{ $category->slug }}</td>
									<td>
										@if($category->parent)
											{{ $data['all_categories']->where("id",$category->parent)->first()->name }}
										@else
											{{ "Root category" }}
										@endif
									</td>
									<td>
										<?php $disabled = $data['all_categories']->where("parent",$category->id)->first(); ?>
										<span class="tooltips" data-original-title="{{$category->status?($disabled?'Can not update status':'Click to deactive'):'Click to active'}}">
											{!! Html::linkroute( 'categories.status', "", array($category->id), array('class' => "btn btn-sm ".($category->status?'btn-success fa fa-check':'btn-danger fa fa-close').($disabled?' disabled':'')) )  !!}
										</span>
									</td>
									<td>
										{!! Form::open(['route'=> ['categories.destroy',$category->id],'method' => 'DELETE']) !!}
											<span class="tooltips" data-original-title="Click to edit">
											{!! Html::linkroute('categories.edit', "", array($category->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil'))  !!}
											</span>
											<span class="tooltips" data-original-title="{{$disabled?'Can not be deleted':'Click to delete'}}">
												{{Form::button('',array('type'=>'submit','class'=> 'btn btn-danger btn-sm fa fa-trash-o'.($disabled?' disabled':''),'onclick'=>"return confirm('Are you sure you want to delete this category?')" )) }}
											</span>
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							@else
								<tr>
									<td colspan="3">No categories Found</td>
								</tr>
							@endif
						</tbody>
					</table>	
					{{ $data['categories']->appends($_GET)->links() }}	
				</div>
			</div>
		</div>
	</div>
@endsection			