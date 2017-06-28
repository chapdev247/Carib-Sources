@extends('templates/frontend/layout')
@section('title','| Home Page')

@section('mainBody')
    <!-- Main component for a primary marketing message or call to action -->
    <div class="well">
        <h1>Welcome to blogs</h1>
        <p>This is Blog in the hits.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="{{ url('blog') }}" role="button">View All Posts &raquo;</a>
        </p>
    </div>
    <div class="">
        @foreach ($posts as $post)
            <div class="col-md-6">
            <h3>
                {!! Html::linkroute('blog.single', $post->title, array($post->slug), array('class' => ''))  !!}
            </h3>
            <p>
                {{ substr( strip_tags($post->body),0,150) }} {{ ( strlen(strip_tags($post->body)) >150 ) ? "..." : "  "  }}
                {!! Html::linkroute('blog.single', "Read More", array($post->slug), array('class' => ''))  !!}
            </p>
            <div>
                <span class="badge badge-success">Posted {{ date("d M,Y h:i",strtotime($post->created_at)) }}</span>
            </div> 
            <hr>
            </div>
        @endforeach
    </div>
@endsection