@extends('templates/backend/layout')
@section('title','| Edit post')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    {!! Html::style("public/css/parsley.css") !!}
@endsection

@section('mainBody')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Post</h1>
            	{!!  Form::model($post, ['route'=> ['posts.update',$post->id],'method' => 'PUT', 'data-parsley-validate' => '','files'=>true] ) !!}
                    <div class="col-md-8">          
                        {{Form::label('title','Title: ')}}<span class="text-danger">*</span>
                        {{Form::text( 'title',null,array('class' => 'form-control', 'data-parsley-required' => '', 'maxlength'=>'250','onkeyup'=>"slugify(this,'slug')" ) )}}
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
                        
                        {{Form::label('slug','Slug: ')}}<span class="text-danger">*</span>
                        {{Form::text( 'slug',null,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-minlength'=>'5', 'data-parsley-maxlength'=>'190', 'data-parsley-pattern'=>"/^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/" ) )}}
                        @if ($errors->first('slug'))
                            <p class="text-danger">
                                {{ $errors->first('slug') }}
                            </p>
                        @endif

                        {{Form::label('category_id','Category: ')}}
                        {{ Form::select( 'category_id',$categories,$post->category_id,array('class' => 'form-control','placeholder' => ' Select Category ' ) )}}
                        @if ($errors->first('category_id'))
                            <p class="text-danger">
                                {{ $errors->first('category_id') }}
                            </p>
                        @endif
                        {{Form::label('tags[]','Tag: ')}}
                        {{ Form::select( 'tags[]',$all_tags,$tags,array('class' => 'form-control' ,'multiple' => true, 'id' => 'my-select') )}}
                        @if ($errors->first('tags[]'))
                            <p class="text-danger">
                                {{ $errors->first('tags[]') }}
                            </p>
                        @endif

                        {{Form::label('body','Body: ')}}<span class="text-danger">*</span>
                        {{Form::textarea( 'body',null,array('class' => 'form-control', 'data-parsley-required' => '', ) )}}
                        @if ($errors->first('body'))
                            <p class="text-danger">
                                {{ $errors->first('body') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            @if(!empty($post->image))
                                <p style="padding: 5px;text-align: center;">
                                    <img src="{{ asset('public/'.$post->thumb_image) }}" height="200px" width="200px">
                                </p>
                            @endif
                            <p> Created At: {{ date("d M,Y h:i",strtotime($post->created_at)) }}</p>
                            <p> Updated At: {{ date("d M,Y h:i",strtotime($post->updated_at)) }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    {!! Html::linkroute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block'))  !!}
                                </div>
                                <div class="col-sm-6">
                                    {{Form::submit('Save Post',array('class'=> 'btn btn-success btn-block' )) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Html::linkroute('posts.index', 'See All Posts', array(), array('class' => 'btn btn-default btn-block'))  !!}
                                </div>
                            </div>
                        </div>
                    </div>
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
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            file_browser_callback : elFinderBrowser,
        });

        function elFinderBrowser (field_name, url, type, win) {
          tinymce.activeEditor.windowManager.open({
            file: "<?php echo route('elfinder.tinymce4'); ?>",
            title: 'elFinder 2.0',
            width: 900,
            height: 450,
            resizable: 'yes'
          }, {
            setUrl: function (url) {
              win.document.getElementById(field_name).value = url;
            }
          });
          return false;
        }
        
    </script>
@endsection