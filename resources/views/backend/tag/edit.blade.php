@extends('templates/backend/layout')

@section('title','| All Categories')

@section('mainBody')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
           		<h1 class="page-header">Edit Tag</h1>
				<div class="col-md-9">	
					<h2></h2>
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
								<td>{{ $tag->name }}</td>
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
						{!!  Form::open( ['route'=> ['tags.update',$t->id],'method' => 'PUT'] ) !!}
							<h3>Edit Tag</h3>
							{{ Form::label('name','Name: ') }}<span class="text-danger">*</span>
							{{ Form::text('name',$t->name, ['class'=> 'form-control']) }}
							@if ($errors->first('name'))
	                            <p class="text-danger">
	                                {{ $errors->first('name') }}
	                            </p>
	                        @endif
							{{ Form::submit('Update Tag', array('class'=>'btn btn-primary btn-block','style'=>'margin-top:20px;')) }}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection			