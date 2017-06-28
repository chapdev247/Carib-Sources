@extends('templates/backend/layout')

@section('title',$data["title"])

@section('stylesheets')
	{!! Html::style("public/css/parsley.css") !!}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection

@section('mainBody')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @include('templates/backend/partials/messages')
            <h3 class="page-title">Edit Profile{{-- <small> Category List</small> --}}</h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Edit Profile
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                @if ($data["user"])
                    {!!  Form::open(['route'=> ['CmsController.postprofile',$data["user"]->id],'method' => 'POST', 'data-parsley-validate' => '','files'=>true] ) !!}

                        <div class="row">
                            <div class="col-lg-6">
                                {{Form::label('f_name','First Name: ')}}<span class=""></span>
                                {{Form::text( 'f_name',$data["user"]->f_name,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-maxlength'=>'50' ) )}}
                                @if ($errors->first('f_name'))
                                    <p class="text-danger">
                                        {{ $errors->first('f_name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-lg-6">
                                {{Form::label('l_name','Last Name: ')}}<span class=""></span>
                                {{Form::text( 'l_name',$data["user"]->l_name,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-maxlength'=>'50' ) )}}
                                @if ($errors->first('l_name'))
                                    <p class="text-danger">
                                        {{ $errors->first('l_name') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            {{Form::label('email','Email: ')}}
                            {{Form::email( 'email',$data["user"]->email,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-type'=>'email', 'data-parsley-maxlength'=>'80' ) )}}
                            @if ($errors->first('email'))
                                <p class="text-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            {{Form::label('email','Email: ')}}
                            {{Form::email( 'email',$data["user"]->email,array('class' => 'form-control', 'data-parsley-required' => '', 'data-parsley-type'=>'email', 'data-parsley-maxlength'=>'80' ) )}}
                            @if ($errors->first('email'))
                                <p class="text-danger">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            {{Form::label('password','Password: ')}}
                            {{Form::password( 'password',array('class' => 'form-control','id'=>'password','data-parsley-minlength'=>'6', 'data-parsley-maxlength'=>'190',  ) )}}
                            @if ($errors->first('password'))
                                <p class="text-danger">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                            {{Form::label('confirm_password','Confirm Password: ')}}
                            {{Form::password( 'confirm_password',array('class' => 'form-control','data-parsley-equalto'=>"#password"  ) )}}
                            @if ($errors->first('confirm_password'))
                                <p class="text-danger">
                                    {{ $errors->first('confirm_password') }}
                                </p>
                            @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                            {{Form::submit('Add Post',array('class'=> 'btn btn-success btn-lg btn-block','style'=> 'margin-top:20px;' )) }}
                            </div>
                        </div>
                	{!! Form::close() !!}
                @else
                    No user found
                @endif

            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('scripts')
	{!! Html::script("public/js/parsley.min.js") !!}
@endsection