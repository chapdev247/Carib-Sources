@extends('templates/backend/layout')

@section('title','| All Tags')

@section('mainBody')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
           		<h1 class="page-header">All Tags</h1>
				<div class="col-md-9">	
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($tags as $tag)
							<tr>
								<td>{{ $tag->id }}</td>
								<td>{{ $tag->name."(".$tag->posts()->count().")"  }}</td>
								<td>
									{!!  Form::open( ['route'=> ['tags.destroy',$tag->id],'method' => 'DELETE'] ) !!}
										{!! Html::linkroute('tags.edit', 'Edit', array($tag->id), array('class' => 'btn btn-primary btn-sm'))  !!}
										{{Form::submit('Delete',array('class'=> 'btn btn-danger btn-sm' )) }}
									{!! Form::close() !!}
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>		
				</div>
				<div class="col-md-3">
					<div class="well">
						{!! Form::open(['route' => 'tags.store']) !!}
							<h3>Add A Tag</h3>
							{{ Form::label('name','Name: ') }}<span class="text-danger">*</span>
							{{ Form::text('name',null, ['class'=> 'form-control']) }}
							@if ($errors->first('name'))
	                            <p class="text-danger">
	                                {{ $errors->first('name') }}
	                            </p>
	                        @endif
							{{ Form::submit('Create New Category',['class'=>'btn btn-primary btn-block','style'=>'margin-top:20px;'])}}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection			