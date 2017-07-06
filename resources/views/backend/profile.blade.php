@extends('templates/backend/layout')

@section('title',$data["title"])

@section('stylesheets')

@endsection

@section('mainBody')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            @include('templates/backend/partials/messages')
            <h3 class="page-title">User Managemnt<small> Edit Profile</small></h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <i class="fa fa-users"></i>
                        <a href="{{route('CmsController.getusers')}}">User Managemnt</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Edit Profile
                    </li>
                </ul>
                <div class="page-toolbar">
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Edit Profile</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body form">
                @if ($data["user"])
                    {!!  Form::open(['route'=> ['CmsController.postprofile',$data["user"]->id],'method' => 'POST', 'data-parsley-validate' => '','files'=>true] ) !!}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    {{Form::label('f_name','First Name')}}<span class="text-danger">* </span> :
                                    {{Form::text( 'f_name',$data["user"]->f_name,array('class' => 'form-control' ) )}}
                                    @if ($errors->first('f_name'))
                                        <p class="text-danger">
                                            {{ $errors->first('f_name') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    {{Form::label('l_name','Last Name')}}<span class="text-danger">* </span> :
                                    {{Form::text( 'l_name',$data["user"]->l_name,array('class' => 'form-control' ) )}}
                                    @if ($errors->first('l_name'))
                                        <p class="text-danger">
                                            {{ $errors->first('l_name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                {{Form::label('email','Email')}}<span class="text-danger">* </span> :
                                {{Form::text( 'email',$data["user"]->email,array('class' => 'form-control' ) )}}
                                @if ($errors->first('email'))
                                    <p class="text-danger">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                {{Form::label('mobile','Mobile')}} :
                                {{Form::text( 'mobile',$data["user"]->mobile,array('class' => 'form-control','maxlength' => 10) )}}
                                @if ($errors->first('mobile'))
                                    <p class="text-danger">
                                        {{ $errors->first('mobile') }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            @if($data["user"]->role>0)
                            <div class="row">
                                <div class="col-lg-12">
                                {{Form::label('role','User Role')}} :
                                {{ Form::select('role', [1=>'Sub-admin',2=>'User'] , $data["user"]->role,array('class'=>"form-control",'id'=>"role")) }}
                                @if ($errors->first('role'))
                                    <p class="text-danger">
                                        {{ $errors->first('role') }}
                                    </p>
                                @endif
                                </div>
                            </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-lg-12">
                                {{Form::label('password','Password')}} :
                                {{Form::password( 'password',array('class' => 'form-control','id'=>'password'  ) )}}
                                @if ($errors->first('password'))
                                    <p class="text-danger">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                {{Form::label('password_confirmation','Confirm Password')}} :
                                {{Form::password( 'password_confirmation',array('class' => 'form-control' ) )}}
                                @if ($errors->first('password_confirmation'))
                                    <p class="text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </p>
                                @endif
                                </div>
                            </div>

                            <div class="form-actions margin-top-10">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-10">
                                        <a href="{{route('CmsController.getusers')}}" class="btn default">Cancel</a>
                                        <button type="submit" class="btn blue">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                	{!! Form::close() !!}
                @else
                    <script>
                        window.location.href = '{{route('CmsController.getusers')}}';
                    </script>
                @endif

            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('scripts')

@endsection