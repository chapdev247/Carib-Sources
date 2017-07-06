@extends('templates/backend/layout')

@section('title',$data["title"])

@section('stylesheets')
<style>
.container {
    margin-bottom: 10px;
    position: relative;
}

.image {
  opacity: 1;
  display: block;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%)
}

.container:hover .image {
  opacity: 0.3;
}

.container:hover .middle {
  opacity: 1;
}
</style>
@endsection

@section('mainBody')
    <div class="page-content-wrapper">
        <div class="page-content loader_wrap">
            <div class="section_loader" id="search_loader">
                <img src="{{asset('public')}}/img/loading-new.gif" alt="Loading..">
            </div>
            @include('templates/backend/partials/messages')
            <h3 class="page-title">Product Management<small> Product Edit</small></h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-cubes"></i>
                        <a href="{{route('products.index')}}">Product List</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Product Edit
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                    </div>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Edit Product</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    @if ($data['product'])
                        {!! Form::open(['route'=> ['products.update_product',$data["product"]->id],'method' => 'POST','class'=>'form-horizontal','files'=>true,'name'=>'product_edit'] ) !!}
                            <div class="form-body"> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="name">Product Name<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                        {{Form::text( 'name',$data["product"]->name,array('class' => 'form-control', 'autocomplete' => 'off' ,'onkeyup'=>"slugify(this,'slug')" ,'id'=>'name' ) )}}
                                        <p class="text-danger name">
                                            @if ($errors->first('name'))
                                              {{ $errors->first('name') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="slug">Product Slug<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                        {{Form::text( 'slug',$data["product"]->slug,array('class' => 'form-control' ,'id'=>'slug' ) ) }}
                                        <p class="text-danger slug">
                                            @if ($errors->first('slug'))
                                              {{ $errors->first('slug') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="category">Product Category<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                        {{ Form::select('category', $data['cat_select'] , $data["product"]->category_id, ['placeholder' => 'Select Product Category','class'=>"form-control",'id'=>"category"]) }}
                                        <p class="text-danger category">
                                            @if ($errors->first('category'))
                                              {{ $errors->first('category') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="price">Product Price<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                        {{Form::text( 'price',$data["product"]->price,array('class' => 'form-control' ,'id'=>'price' ) )}}
                                        <p class="text-danger price">
                                            @if ($errors->first('price'))
                                              {{ $errors->first('price') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="price">Product Images<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                        <?php $images = json_decode($data["product"]->thumb_image);
                                        if(!empty($images)){
                                            foreach ($images as $key => $image) { ?>
                                                <div class="container col-md-3">
                                                    <img src="{{ asset('public/'.$image) }}" width="200px" class="image img-responsive">
                                                    <div class="middle">
                                                        <a href="{{ route('products.delete_image',[$data['product']->id, $key]) }}" class="btn btn-sm btn-danger fa fa-trash-o" onclick="return confirm('Are you sure you want to delete this image?')" ></a>
                                                    </div>
                                                </div>
                                                <?php
                                            } 
                                        }?>
                                        {{ Form::file('image[]', ['class'=> 'form-control' ,'id'=>'name' ,'placeholder'=>'Enter Product image','id'=>'image','multiple'=>true]) }}
                                        <ul class="text-success">
                                            <li>Allowed image types are png, gif, jpeg, jpg.</li>
                                            <li>Image dimensions must be atleast 440X480.</li>
                                            <li>Maximum image size is 2MB.</li>
                                        </ul>
                                        <p class="text-danger image">
                                            @if ($errors->first('image'))
                                              {{ $errors->first('image') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                            		<label class="col-md-3 control-label" for="description">Product Description<span class="text-danger">* </span> :</label>
                                    <div class="col-md-9">
                                		{{Form::textarea( 'description',$data["product"]->description,array('class' => 'form-control' ,'id'=>'description' ) )}}
                                        <p class="text-danger description">
                            		      @if ($errors->first('description'))
                        			            {{ $errors->first('description') }}
                        			     @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="form-actions margin-top-10">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-10">
                                            <a href="{{route('products.index')}}" class="btn default">Cancel</a>
                                            <button type="submit" class="btn blue">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    	{!! Form::close() !!}
                    @else
                        <script>
                            window.location.href = '{{route('products.index')}}';
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#search_loader").hide();
        $("form[name='product_edit']").submit(function(e) {
            $("#search_loader").show();
            var form = this;
            var formData = new FormData(form);
            $("p.text-danger").html('');
            $.ajax({
                type:'POST',
                url:"{{ route('products.update_product',$data['product']->id) }}",
                data:formData,
                async: false,
                success:function(response){
                    window.location.href = document.URL;
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (err) {
                    $.each(err.responseJSON, function( index, value ) {
                        var error = '';
                        $.each(value, function( i_index, i_value ) {
                            if (i_value.indexOf("###")) 
                                i_value = i_value.replace("###"," ");
                            error = error + i_value + "<br>";
                        });
                        if (index.indexOf("###")) 
                            index = index.split("###")[0];
                        $("p.text-danger."+index+"").html(error);
                    });
                    $("#search_loader").hide();
                }
            });
            e.preventDefault();
        });
    </script>
@endsection