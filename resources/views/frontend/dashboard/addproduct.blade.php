<h2 class="heading">Add Product</h2>
{!! Form::open(['route'=> ['addproduct'],'method' => 'POST','class'=>'form-horizontal','files'=>true,'name'=>'products'] ) !!}
	<div class="theme-form-section loader_wrap">
        <div class="section_loader" id="search_loader">
            <img src="{{asset('public')}}/img/loading-new.gif" alt="Loading..">
        </div>
		<div class="form-group clearfix">
            <label for="name" class="col-sm-3 control-label">Product Name<span class="mandatory">*</span> <span class="colon">:</span></label>
            <div class="col-sm-7">
                {{ Form::text('name',null, ['class'=> 'form-control','placeholder'=>'Enter Product Name','id'=>'name']) }}
                <p class="text-danger name">
                @if ($errors->has('name'))
                        <strong>{{ $errors->first('name') }}</strong>
                @endif
                </p>
            </div>
        </div>
        <div class="form-group clearfix">
            <label for="category" class="col-sm-3 control-label">Product Category<span class="mandatory">*</span> <span class="colon">:</span></label>
            <div class="col-sm-7">
                {{ Form::select('category', $data['cat_select'] , null, ['placeholder' => 'Select Product Category','class'=>"form-control",'id'=>"category"]) }}
                {{-- <select name="category" class="form-control">
                	<option>Select Product Category</option>
                </select> --}}
                <p class="text-danger category">
                @if ($errors->has('category'))
                        <strong>{{ $errors->first('category') }}</strong>
                @endif
                </p>
            </div>
        </div>
  		<div class="form-group clearfix">
		    <label for="description" class="col-sm-3 control-label">Product Details<span class="mandatory">*</span> <span class="colon">:</span></label>
		    <div class="col-sm-7">
		    	{{ Form::textarea('description',null, ['class'=> 'form-control','placeholder'=>'Enter Product Details','id'=>'description']) }}
                <p class="text-danger description">
		    	@if ($errors->has('description'))
                        <strong>{{ $errors->first('description') }}</strong>
                @endif
                </p>
		    </div>
  		</div>
  		<div class="form-group clearfix">
            <label for="image" class="col-sm-3 control-label">Product Image <span class="colon">:</span></label>
            <div class="col-sm-7">
                {{ Form::file('image[]', ['class'=> 'form-control','placeholder'=>'Enter Product image','id'=>'image','multiple'=>true]) }}
                <ul class="text-success">
                    <li>Allowed image types are png, gif, jpeg, jpg.</li>
                    <li>Image dimensions must be atleast 440X480.</li>
                    <li>Maximum image size is 2MB.</li>
                </ul>
                <p class="text-danger image">
                @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                @endif
                </p>
            </div>
        </div>	
        <div class="form-group clearfix">
            <label for="price" class="col-sm-3 control-label">Product Price<span class="mandatory">*</span> <span class="colon">:</span></label>
            <div class="col-sm-7">
                {{ Form::text('price',null, ['class'=> 'form-control','placeholder'=>'Enter Product Quantity','id'=>'price']) }}
                <p class="text-danger price">
                @if ($errors->has('price'))
                        <strong>{{ $errors->first('price') }}</strong>
                @endif
                </p>
            </div>
        </div>
	  	<div class="form-group">
			<div class="button-block text-center btn-padding">
              <button id="submit" type="submit" value="Submit" class="btn btn-orange btn-theme btn-lg">Add Product</button>
           </div>
	  	</div>
	</div>
{!! Form::close() !!}
@section('innerscripts')
    <script src="{{asset('public')}}/js/tinymce/tinymce.min.js?apiKey=9ic9deq566guw4ojcjan0hunss4jkx3xuy8xgsvzh6lz8hwd"></script>
    <script type="text/javascript">
        $("form[name='products']").submit(function(e) {
            tinyMCE.triggerSave();
            var form = this;
            var formData = new FormData(form);
            $("p.text-danger").html('');
            $.ajax({
                type:'POST',
                url:"{{ route('addproduct') }}",
                data:formData,
                async: false,
                success:function(response){
                    window.location = document.URL;
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
                }
            });
            e.preventDefault();
        });
        tinymce.init({ 
            selector : 'textarea',
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
            //file_browser_callback : elFinderBrowser,
        });
    </script>
@endsection