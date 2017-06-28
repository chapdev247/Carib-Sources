@extends('templates/frontend/layout')
@section('title','| All Products')

@section('mainBody')
  	<!-- Main component for a primary marketing message or call to action -->
	<div class="">
		<div class="row">
			@foreach ($products as $product)
	                <div class="col-sm-4 col-lg-4 col-md-4">
	                    <div class="thumbnail">
	                    	<a href="{{ route('shop.single', $product->sku) }}">
	                        	<img src="{{ asset('public/'.$product->thumb_image) }}" alt="">
	                    	</a>
	                        <div class="caption">
	                            <h4 class="pull-right">$ {{ $product->price }}</h4>
	                            <h4>{!! Html::linkroute('shop.single', $product->name, array($product->sku), array('class' => ''))  !!}</h4>
	                            <p>
	                            	{{ substr( strip_tags($product->description),0,180) }} {{ ( strlen(strip_tags($product->description)) >180 ) ? "..." : "  "  }}
									{!! Html::linkroute('shop.single', "View More", array($product->sku), array('class' => ''))  !!}
								</p>
	                        </div>
	                        <div class="ratings">
	                            <p class="pull-right">15 reviews</p>
	                            <p>
	                                <span class="glyphicon glyphicon-star-empty"></span>
	                                <span class="glyphicon glyphicon-star-empty"></span>
	                                <span class="glyphicon glyphicon-star-empty"></span>
	                                <span class="glyphicon glyphicon-star-empty"></span>
	                                <span class="glyphicon glyphicon-star-empty"></span>
	                            </p>
	                        </div>
	                    </div>
	                </div>
			@endforeach
        </div>
		<div class="text-center">
			{{ $products->links() }}
		</div>
	</div>
@endsection