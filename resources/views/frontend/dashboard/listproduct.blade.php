<div class="heading" style="position: relative;">
	<h2 class="">Product List</h2>
	<a href="{{ route('dashboard',array('products','add')) }}" class="btn btn-membership pull-right btn-addproduct"><i class="fa fa-plus"></i> Add Product</a>
</div>
{{-- <table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Category</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody> --}}
		@if(count($data["products"])>0)
			@foreach($data["products"] as $p_key => $product)
				<div class="account-pro-list-block">
			 		<div class="product-img">
			 			<a href="#">
			 			@if(count(json_decode($product->thumb_image))>0)
                            <img src="{{asset('public').'/'.json_decode($product->thumb_image)[0]}}" class="img-thumbnail" title="{{$product->name}}">
                        @else
                            <img src="{{asset('public')}}/img/default-thumbnail.jpg" class="img-thumbnail">
                        @endif
			 			</a>
			 		</div>
			 		<div class="product-desc">
			 			<h2 class="prodcut-name"><a href="#">Design tool machine</a></h2>
			 			<div class="desc">
			 				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			 				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			 			</div>
			 			<div class="info-block">
				 			<span>
				 				<b>Category :</b> 
				 				<a href="#">
						 			@if($product->category && $product->category->status==1)
			                            {{$product->category->name}}
			                        @else
			                            ----
			                        @endif
			                    </a>
	                        </span>
			 			</div>
			 		</div>
			 		<div class="action-block">
			 			<!-- <h4 class="price-tag">Quote Price</h4>
			 			<h4>$ 200</h4> -->
			 			<div class="action-btn-block">
				 			<ul class="list-inline">
				 				<li>
				 					<a href="{{route('dashboard',['products','edit',$product->id])}}" data-toggle="tooltip" data-original-title="Edit">
				 						<i class="fa fa-pencil" aria-hidden="true"></i>
				 					</a>
				 				</li>
				 				<li>
				 					<a href="{{route( 'statusproduct',$product->id)}}" data-toggle="tooltip" data-original-title="Change Status">
				 						@if($product->status)
				 							<i class="fa fa-check" aria-hidden="true"></i>
				 						@else
				 							<i class="fa fa-close" aria-hidden="true"></i>
				 						@endif
				 					</a>
				 				</li>
				 				<li>
				 					<a href="{{route('destroyproduct',[$product->id])}}" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
				 						<i class="fa fa-trash-o" aria-hidden="true"></i>
				 					</a>
				 				</li>
				 			</ul>
			 			</div>
			 			<div class=""><a href="#" class="btn btn-default">View Quotes</a></div>
			 		</div>
			 	</div>
				{{-- <tr>
					<td>{{$p_key+1}}</td>
					<td>{{$product->name}}</td>
					<td>
						@if($product->category && $product->category->status==1)
                            {{$product->category->name}}
                        @else
                            =======
                        @endif
					</td>
					<td>
						
                    </td>
					<td>
                        <span class="tooltips" data-original-title="Click to edit">
                            {!! Html::linkroute('dashboard', '', array('products','edit',$product->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil'))  !!}
                        </span>
                        <span class="tooltips" data-original-title="Click to delete">
                            {!! Html::linkroute('destroyproduct', '', array($product->id), array('class' => 'btn btn-danger btn-sm fa fa-trash-o'))  !!}
                        </span>
                    </td>
				</tr> --}}
			@endforeach
		@else
			<tr>
				<td>No Product Found</td>
			</tr>
		@endif
{{-- 	</tbody>
</table> --}}
<div>
    {{ $data["products"]->appends($_GET)->links() }}
</div>