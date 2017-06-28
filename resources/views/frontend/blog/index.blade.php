@extends('templates/frontend/layout')
@section('title','| All posts')

@section('mainBody')
  	<!-- Main component for a primary marketing message or call to action -->
	<div class="">
		@foreach ($posts as $post)
			<h1>
				{!! Html::linkroute('blog.single', $post->title, array($post->slug), array('class' => ''))  !!}
			</h1>
			<p>
				{{ substr( strip_tags($post->body),0,150) }} {{ ( strlen(strip_tags($post->body)) >150 ) ? "..." : "  "  }}
				{!! Html::linkroute('blog.single', "Read More", array($post->slug), array('class' => ''))  !!}
			</p>
			<div>
			    <span class="badge badge-success">Posted {{ date("d M,Y h:i",strtotime($post->created_at)) }}</span>
			</div> 
			<hr>
		@endforeach
		<div class="text-center">
			{{ $posts->links() }}
		</div>
	</div>
@endsection