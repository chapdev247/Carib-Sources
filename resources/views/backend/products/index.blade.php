@extends('templates/backend/layout')

@section('title',$data["title"])

@section('stylesheets')
    <style type="text/css">
        .padding_left_10 {
            padding-left: 10px;
        }
        .padding_right_10 {
            padding-right: 10px;
        }
    </style>
@endsection

@section('mainBody')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include('templates/backend/partials/messages')
            <h3 class="page-title">Product Management<small> Product List</small></h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Product List
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="get">
                        <div class="col-lg-3" style="width: 20%;padding-left: 0px;padding-right: 0px;">
                            {{ Form::text('search',null, ['class'=> 'form-control','placeholder'=>'Search by Name,slug..','id'=>'search','autofocus'=>'on']) }}
                        </div>
                        <div class="col-lg-2" style="width: 18%;padding-left: 10px;padding-right: 0px;">
                            {{ Form::select('category_id', $data['cat_select'] , null, ['class'=>"form-control",'id'=>"category_id"]) }}
                        </div>
                        <div class="col-lg-2">
                            {{ Form::select('featured', [""=>'Is featured?',0=>"Not Featured",1=>"Featured"] , null, ['class'=>"form-control",'id'=>"featured"]) }}
                        </div>
                        <div class="col-lg-2">
                            {{ Form::select('status', [""=>'Select Status',0=>"Inactive",1=>"Active"] , null, ['class'=>"form-control",'id'=>"status"]) }}
                        </div>
                        <div class="col-lg-2">
                            {{ Form::select('sort', [""=>'Sort by',"ASC"=>"ASC","DESC"=>"DESC"] , null, ['class'=>"form-control",'id'=>"sort"]) }}
                        </div>
                        <div class="col-lg-2" style="width: 12%; padding-right: 0px;padding-left: 0px;">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search" data-toggle="tooltip" data-title="Search"></i></button>
                            <a href="{{route('products.index')}}" class="btn btn-danger" data-toggle="tooltip" data-title="Reset"><i class="fa fa-close"></i></a> 
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Created / Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($data["products"])>0)
                                    @foreach ($data["products"] as $index => $product)
                                    <tr>
                                        <td>{{ (($data['products']->currentPage()-1)*$data['products']->perPage())+($index+1) }}</td>
                                        <td>{!! Html::linkroute('products.edit', $product->name , array($product->id), array('class' => ''))  !!}</td>
                                        <td>
                                            @if($product->category)
                                                {{$product->category->name}}
                                            @else
                                                ---
                                            @endif
                                        </td>
                                        <td>
                                            <span class="tooltips" data-original-title="{{$product->status?'Click to deactive':'Click to active'}}">
                                                {!! Html::linkroute( 'products.status', "", array($product->id), array('class' => "btn btn-sm ".($product->status?'btn-success fa fa-check':'btn-danger fa fa-close')) )  !!}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->featured)
                                                Y
                                            @else
                                                N
                                            @endif
                                        </td>
                                        <td>{{ date("d M,Y h:i",strtotime($product->created_at))." / ".date("d M,Y h:i",strtotime($product->updated_at)) }}</td>
                                        <td>
                                            {!! Form::open(['route'=> ['products.destroy',$product->id],'method' => 'DELETE']) !!}
                                                <span class="tooltips" data-original-title="Click to edit">
                                                    {!! Html::linkroute('products.edit', '', array($product->id), array('class' => 'btn btn-primary btn-sm fa fa-pencil'))  !!}
                                                </span>
                                                <span class="tooltips" data-original-title="Click to delete">
                                                    {{Form::button('',array('type'=>'submit','class'=> 'btn btn-danger btn-sm fa fa-trash-o','onclick'=>"return confirm('Are you sure you want to delete this product?')") ) }}
                                                </span>
                                            {!! Form::close() !!}
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"><strong><center>No products found</center></strong></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div>
                            {{ $data["products"]->appends($_GET)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	{!! Html::script("public/js/parsley.min.js") !!}
@endsection