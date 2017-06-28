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
            <div class="col-lg-12">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Slug</th>
							<th>Parent</th>
							<th>status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if (count($data['categories'])>0)
							@foreach ($data['categories'] as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->slug }}</td>
								<td>
									@if($category->parent)
										{{ $data['categories']->where("id",$category->parent)->first()->name }}
									@else
										{{ "Root category" }}
									@endif
								</td>
								<td>
									@if(!$data['categories']->where("parent",$category->id)->first())
										{!! Html::linkroute('categories.status', "", array($category->id), array('class' => $category->status?'btn btn-sm btn-success fa fa-check':'btn btn-sm btn-danger fa fa-close'))  !!}
									@endif
								</td>
								{{-- ."(".$category->posts()->count().")" --}}
								<td>
									{!! Form::open(['route'=> ['categories.destroy',$category->id],'method' => 'DELETE']) !!}
										{!! Html::linkroute('categories.edit', "", array($category->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil'))  !!}
										@if(!$data['categories']->where("parent",$category->id)->first())
											{{Form::button('',array('type'=>'submit','class'=> 'btn btn-danger btn-sm fa fa-trash-o' )) }}
										@endif
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
			</div>
		</div>
	</div>
@endsection			