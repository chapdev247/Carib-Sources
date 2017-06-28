@extends('templates/backend/layout')

@section('title','| Add post')

@section('stylesheets')
	{!! Html::style("public/css/parsley.css") !!}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

@section('mainBody')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create Post</h1>
            	{!!  Form::open(array('name' => 'postAdd','route' => 'posts.store', 'data-parsley-validate' => '', 'files'=>true, )) !!}
            		{{Form::label('title','Title: ')}}<span class="text-danger">*</span>
            		{{Form::text( 'title',null,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-maxlength'=>'190' ,'onkeyup'=>"slugify(this,'slug')" ) )}}
            		@if ($errors->first('title'))
        			    <p class="text-danger">
        			        {{ $errors->first('title') }}
        			    </p>
        			@endif

                    {{Form::label('featured_image','Featured Image: ')}}
                    <input type="file" name="featured_image" id="multiupload" class="form-control">
                    @if ($errors->first('featured_image'))
                        <p class="text-danger">
                            {{ $errors->first('featured_image') }}
                        </p>
                    @endif

                    {{Form::label('slug','Slug: ')}}
                    {{Form::text( 'slug',null,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-minlength'=>'5', 'data-parsley-maxlength'=>'190', 'data-parsley-pattern'=>"/^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/") )}}
                    @if ($errors->first('slug'))
                        <p class="text-danger">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif

                    @if (!empty($categories))
                    {{Form::label('category_id','Category: ')}}
                    {{ Form::select( 'category_id',$categories,null,array('class' => 'form-control','placeholder' => ' Select Category ' ) )}}
                    @endif
                    @if ($errors->first('category_id'))
                        <p class="text-danger">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif

                    @if (!empty($tags))
                    {{Form::label('tags[]','Tag: ')}}
                    {{ Form::select( 'tags[]',$tags,null,array('class' => 'form-control' ,'multiple' => true, 'id' => 'my-select') )}}
                    @endif
                    @if ($errors->first('tags[]'))
                        <p class="text-danger">
                            {{ $errors->first('tags[]') }}
                        </p>
                    @endif

            		{{Form::label('body','Body: ')}}<span class="text-danger">*</span>
            		{{Form::textarea( 'body',null,array('class' => 'form-control', ) )}}
            		@if ($errors->first('body'))
        			    <p class="text-danger">
        			        {{ $errors->first('body') }}
        			    </p>
        			@endif

            		{{Form::submit('Add Post',array('class'=> 'btn btn-success btn-lg btn-block','style'=> 'margin-top:20px;' )) }}

            	{!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	{!! Html::script("public/js/parsley.min.js") !!}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=9ic9deq566guw4ojcjan0hunss4jkx3xuy8xgsvzh6lz8hwd"></script>
    <script type="text/javascript">
        $("#my-select").select2();
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
                { title: 'Lorem Ipsum', content: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
         });
    </script>
@endsection