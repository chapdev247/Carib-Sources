@extends('templates/frontend/layout')

@section('title',"| $product->name")

@section('mainBody')
	@if (isset($product))
		<div class="container-fluid">
		    <div class="content-wrapper">	
				<div class="item-container">	
					<div class="container">	
						<div class="col-md-12">
							<div class="product col-md-5 service-image">
								<center>
									<img id="item-display" src="{{ asset('public/'.$product->image) }}" alt=""></img>
								</center>
							</div>
							
							<div class="col-md-7">
								<div class="product-title">
									@if (Auth::guard("admin")->check())
										{!! Html::linkroute('ProductController.getedit', $product->name, array($product->id), array('data-toggle'=>'tooltip','title'=>'Edit Product','target'=>"_blank"))  !!}
						            @else
						            	{{$product->name}}
						            @endif
								</div>
								<div class="product-desc">The Corsair Gaming Series GS600 is the ideal price/performance choice for mid-spec gaming PC</div>
								<div class="product-rating"><i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star gold"></i> <i class="fa fa-star-o"></i> </div>
								<hr>
								<div class="product-price">$ {{$product->price}}</div>
								<div class="product-stock">In Stock</div>
								<hr>
								<div class="btn-group cart">
								{!!  Form::open(array('name' => 'cartAdd','route' => 'CartController.postaddtocart','files'=>true, )) !!}
									<input type="hidden" name="id" value="{{$product->id}}">
									<button type="submit" class="btn btn-success">
										Add to cart 
									</button>
								{!! Form::close() !!}
								</div>
								<div class="btn-group wishlist">
									<button type="button" class="btn btn-danger">
										Add to wishlist 
									</button>
								</div>
							</div>
						</div>
					</div> 
				</div>
				<div class="container-fluid">		
					<div class="col-md-12 product-info">
							<ul id="myTab" class="nav nav-tabs nav_tabs">
								
								<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
								<li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>
								<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>
								
							</ul>
						<div id="myTabContent" class="tab-content">
								<div class="tab-pane fade in active" id="service-one">
								 
									<section class="container product-info">
										{!! $product->description !!}
									</section>
												  
								</div>
							<div class="tab-pane fade" id="service-two">
								
								<section class="container">
									@if($product->product_info)
										{!! $product->product_info !!}
									@else
										{!! "<p>No additional information.</p>" !!}
									@endif
								</section>
								
							</div>
							<div class="tab-pane fade" id="service-three">
														
							</div>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	@else
		<h1>No Post Found</h1>
	@endif
@endsection			
<style type="text/css">
	/*********************************************
        		Theme Elements
*********************************************/

.gold{
	color: #FFBF00;
}

/*********************************************
					PRODUCTS
*********************************************/

.product{
	border: 1px solid #dddddd;
	height: 321px;
}

.product>img{
	max-width: 230px;
}

.product-rating{
	font-size: 20px;
	margin-bottom: 25px;
}

.product-title{
	font-size: 20px;
}

.product-desc{
	font-size: 14px;
}

.product-price{
	font-size: 22px;
}

.product-stock{
	color: #74DF00;
	font-size: 20px;
	margin-top: 10px;
}

.product-info{
		margin-top: 50px;
}

/*********************************************
					VIEW
*********************************************/

.content-wrapper {
	max-width: 1140px;
	background: #fff;
	margin: 0 auto;
	margin-top: 25px;
	margin-bottom: 10px;
	border: 0px;
	border-radius: 0px;
}

.container-fluid{
	max-width: 1140px;
	margin: 0 auto;
}

.view-wrapper {
	float: right;
	max-width: 70%;
	margin-top: 25px;
}

.container {
	padding-left: 0px;
	padding-right: 0px;
	max-width: 100%;
}

/*********************************************
				ITEM 
*********************************************/

.service1-items {
	padding: 0px 0 0px 0;
	float: left;
	position: relative;
	overflow: hidden;
	max-width: 100%;
	height: 321px;
	width: 130px;
}

.service1-item {
	height: 107px;
	width: 120px;
	display: block;
	float: left;
	position: relative;
	padding-right: 20px;
	border-right: 1px solid #DDD;
	border-top: 1px solid #DDD;
	border-bottom: 1px solid #DDD;
}

.service1-item > img {
	max-height: 110px;
	max-width: 110px;
	opacity: 0.6;
	transition: all .2s ease-in;
	-o-transition: all .2s ease-in;
	-moz-transition: all .2s ease-in;
	-webkit-transition: all .2s ease-in;
}

.service1-item > img:hover {
	cursor: pointer;
	opacity: 1;
}

.service-image {
	padding-top: 15px;
	padding-bottom: 15px;
}

.service-image > center > img{
	height: 100%;
	width: 100%;
}

</style>