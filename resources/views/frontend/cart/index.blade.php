@extends('templates/frontend/layout')
@section('title','| All Products')

@section('mainBody')
  	<!-- Main component for a primary marketing message or call to action -->
	<div class="">
		<div class="row">
		   	@if($cart::count()>0)
			{!!  Form::open(array('name' => 'cartUpdate','route' => 'CartController.postupdatecart', 'data-parsley-validate' => '' )) !!}
			<table class="table table-hover">
			   	<thead>
			       	<tr>
			           	<th>Product</th>
			           	<th>Qty</th>
			           	<th>Unit Price(Price+Tax)</th>
			           	<th>Total</th>
			           	<th></th>
			       	</tr>
			   	</thead>
			   	<tbody>
	   				<?php $cart_content = $cart::contents(); ?>
			   		@foreach($cart_content as $row)

			       		<tr>
			           		<td>
			               		<p><strong><?php echo $row->name; ?></strong></p>
			           		</td>
			           		<td>
			           		<input type="text" name="<?php echo "product[".$row->rowId."]"; ?>" value="<?php echo $row->qty; ?>"></td>
			           		<td>$ <?php echo $row->priceTax."(".$row->price."+".$row->tax.")"; ?></td>
			           		<td>$ <?php echo $row->total; ?></td>
			           		<td>{!! Html::linkroute('CartController.getremovecart', "X" , array($row->rowId), array('class' => 'btn btn-danger'))  !!}</td>
			       		</tr>

				   	<?php endforeach;?>

			   	</tbody>
			   	
			   	<tfoot>
			   		<tr>
			   			<td colspan="2">&nbsp;</td>
			   			<td>Subtotal</td>
			   			<td>$ <?php echo $cart::subtotal(); ?></td>
			   			<td></td>
			   		</tr>
			   		<tr>
			   			<td colspan="2">&nbsp;</td>
			   			<td>Tax</td>
			   			<td>$ <?php echo $cart::tax(); ?></td>
			   			<td></td>
			   		</tr>
			   		<tr>
			   			<td colspan="2">
			   				{{Form::submit('Update Cart',array('class'=> 'btn btn-warning')) }}
			   				{!! Html::linkroute('CartController.getemptycart', "Empty Cart" , array(), array('class' => 'btn btn-danger'))  !!}
			   			</td>
			   			<td>Total</td>
			   			<td>$ <?php echo $cart::total(); ?></td>
			   			<td></td>
			   		</tr>
			   	</tfoot>
			</table>
			{!! Form::close() !!}
		   	@else
		   		<h4>Your Cart is empty!</h4>
		   	@endif
        </div>
	</div>
@endsection