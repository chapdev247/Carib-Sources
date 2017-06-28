@extends('templates/frontend/layout')

@section('title',"| $post->title")

@section('mainBody')
	@if (isset($post))
		<div class="row">
			<div class="col-md-10 col-md-offset-1">	
				<div>		
					<h1>{{ $post->title }}</h1>
					<p class="">
						@if(!empty($post->image))
							<img src="{{ asset('public/'.$post->image) }}" class="img-responsive">
						@endif
					</p>
					<p class="">
						{!! $post->body !!}
					</p>
					<p class="">
						@if(!empty($post->category->name))
							<div class="label label-success">{{ $post->category->name }}</div>
						@endif
					</p>
					<p>
						@if(!empty($post->tags))
							@foreach ($post->tags as $tag)
								<div class="label label-default"><i class="fa fa-tags" aria-hidden="true"></i> {{ $tag->name }}</div>	
							@endforeach
						@endif
					</p>
					<p>
						Posted On: {{ date("d M,Y h:i",strtotime($post->created_at)) }}
					</p>
				</div>
				<div>
					<hr>
					<h3><b>Comments :</b></h3>
					<?php $comments = $post->comments->where('approved',true) ?>
					@if( !empty($comments[0]) )
						@foreach($comments as $comment)
							@if($comment->approved)
								<p> <b> {{ $comment->name }} : </b> {{ $comment->comment }} </p>
							@endif
						@endforeach
					@else
						<p><b>No Comments Found</b></p>
					@endif
				</div>
				<div>
					<hr>
						{!!  Form::model($post, ['route'=> ['comments.store',$post->id],'method' => 'POST'] ) !!}
							@if (Auth::check()===false)
								<div class="col-md-6">
									{{Form::label('name','Name: ')}}
					                {{Form::text( 'name',null,array('class' => 'form-control') )}}
					                @if ($errors->first('name'))
					                    <p class="text-danger">
					                        {{ $errors->first('name') }}
					                    </p>
					                @endif
								</div>	
								<div class="col-md-6">
									{{Form::label('email','Email: ')}}
					                {{Form::text( 'email',null,array('class' => 'form-control') )}}
					                @if ($errors->first('email'))
					                    <p class="text-danger">
					                        {{ $errors->first('email') }}
					                    </p>
					                @endif
								</div>	
							@endif
							<div class="col-md-12">
								{{Form::label('comment','Comment: ')}}
				                {{Form::textarea( 'comment',null,array('class' => 'form-control') )}}
				                @if ($errors->first('comment'))
				                    <p class="text-danger">
				                        {{ $errors->first('comment') }}
				                    </p>
				                @endif

								{{Form::submit('Add Comment',['class'=>'btn btn-primary btn-block','style'=>'margin-top:20px;'])}}
							</div>	
						{!! Form::Close() !!}
				</div>
			</div>
		</div>
	@else
		<h1>No Post Found</h1>
	@endif
@endsection			