@extends('templates/backend/layout')

@section('title','| Add Product')

@section('stylesheets')
	{!! Html::style("public/css/parsley.css") !!}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

@section('mainBody')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">All Products</h1>
                <div class="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Created / Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{!! Html::linkroute('ProductController.getedit', $product->name , array($product->id), array('class' => ''))  !!}</td>
                                <td>
                                    @if ($product->category)
                                        {{ $product->category->name }}
                                    @else
                                        {{ "--" }}
                                    @endif 
                                </td>
                                <td>{{ date("d M,Y h:i",strtotime($product->created_at))." / ".date("d M,Y h:i",strtotime($product->updated_at)) }}</td>
                                <td>
                                    {!! Html::linkroute('blog.single', "", array($product->sku), array('class' => 'btn btn-success btn-sm fa fa-clone','target'=>'_blank','data-toggle'=>'tooltip','title'=>'View Product'))  !!}
                                    {!! Html::linkroute('ProductController.getedit', '', array($product->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil','data-toggle'=>'tooltip','title'=>'Edit Product'))  !!}
                                    {!! Html::linkroute('ProductController.getdestroy', '', array($product->id), array('class' => 'btn btn-danger btn-sm fa fa-trash','data-toggle'=>'tooltip','title'=>'Delete Product'))  !!}
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	{!! Html::script("public/js/parsley.min.js") !!}
@endsection