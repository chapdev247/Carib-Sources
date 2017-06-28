@extends('templates/backend/layout')

@section('title','| Show Post')

@section('mainBody')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Comments</h1>
				<div class="col-md-12">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Comment</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@if( !empty($post->comments[0]) )
								@foreach($post->comments as $comment)
								<tr>
									<td>{{ $comment->id }}</td>
									<td>{{ $comment->name }}</td>
									<td>{{ $comment->email }}</td>
									<td>{{ substr($comment->comment,0,50).".." }}</td>
									<td>
										{!!  Form::open( ['route'=> ['comments.destroy',$comment->id],'method' => 'DELETE'] ) !!}
											@if ($comment->approved)
												{!! Html::linkroute('comments.update', '', array($comment->id), array('class' => 'btn btn-success btn-sm fa fa-check-circle','data-toggle' => 'tooltip','Title' => 'Unapprove'))  !!}
											@else
												{!! Html::linkroute('comments.update', '', array($comment->id), array('class' => 'btn btn-warning btn-sm fa fa-times-circle','data-toggle' => 'tooltip','Title' => 'Approve'))  !!}
											@endif
											<button type="submit" class="btn btn-danger btn-sm" data-toggle='tooltip' title='Delete Comment'><i class="fa fa-trash-o" aria-hidden="true"></i></button>
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							@else
								<tr>
									<th colspan="5"><center>No Comments Found</center></th>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				<div class="col-md-8">			
					<h1>{{ $post->title }}</h1>
					<p class="">{{ substr(  strip_tags($post->body),0,1000).( strlen( strip_tags($post->body) ) > 1000 ? " ... " :"") }}</p>
					@if (isset($post->category->name))
						<p class="text-success">{{ $post->category->name }}</p>
					@endif
				</div>
				<div class="col-md-4">
					<div class="well">
						@if(!empty($post->image))
                            <p style="padding: 5px;text-align: center;">
                                <img src="{{ asset('public/'.$post->thumb_image) }}" height="200px" width="200px">
                            </p>
                        @endif
						<p> Created At: {{ date("d M,Y h:i",strtotime($post->created_at)) }}</p>
                        <p> Updated At: {{ date("d M,Y h:i",strtotime($post->updated_at)) }}</p>
						<hr>
						<div class="row">
							<div class="col-sm-6">
								{!! Html::linkroute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block'))  !!}
							</div>
							<div class="col-sm-6">
								{!!  Form::open( ['route'=> ['posts.destroy',$post->id],'method' => 'DELETE'] ) !!}
									{{Form::submit('Delete',array('class'=> 'btn btn-danger btn-block' )) }}
								{!! Form::close() !!}
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
								{!! Html::linkroute('posts.index', 'See All Posts', array(), array('class' => 'btn btn-default btn-block'))  !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection			