@extends('templates/backend/layout')
@section('title','| All posts')

@section('mainBody')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
           		<h1 class="page-header">All Posts</h1>
				{{-- {!! Html::linkroute('posts.create', ' +Add Post ', array(), array('class' => 'btn btn-success btn-lg text-right'))  !!} --}}
			  	<!-- Main component for a primary marketing message or call to action -->
				<div class="">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Title (No. of comments)</th>
								<th>Category</th>
								<th>Created / Updated</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($posts as $post)
							<tr>
								<td>{{ $post->id }}</td>
								<td>{!! Html::linkroute('posts.show', $post->title." (".$post->comments()->count().") " , array($post->id), array('class' => ''))  !!}</td>
								<td>
									@if ($post->category)
										{{ $post->category->name }}
									@else
										{{ "--" }}
									@endif 
								</td>
								<td>{{ date("d M,Y h:i",strtotime($post->created_at))." / ".date("d M,Y h:i",strtotime($post->updated_at)) }}</td>
								<td>
							    	{!!  Form::open( ['route'=> ['posts.destroy',$post->id],'method' => 'DELETE'] ) !!}
							    		{!! Html::linkroute('blog.single', "", array($post->slug), array('class' => 'btn btn-success btn-sm fa fa-clone','target'=>'_blank','data-toggle'=>'tooltip','title'=>'View Post'))  !!}
								    	{!! Html::linkroute('posts.show', '', array($post->id), array('class' => 'btn btn-warning btn-sm fa fa-comments-o','data-toggle'=>'tooltip','title'=>'Edit Comments'))  !!}
								    	{!! Html::linkroute('posts.edit', '', array($post->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil','data-toggle'=>'tooltip','title'=>'Edit Post'))  !!}
										{{Form::submit('X',array('class'=> 'btn btn-danger btn-sm fa fa-trash','data-toggle'=>'tooltip','title'=>'Delete Post' )) }}
									{!! Form::close() !!}
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="text-center">
						{{ $posts->links() }}
					</div>
				</div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection