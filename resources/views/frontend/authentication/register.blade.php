@extends('templates/frontend/layout')
@section('title',$data["title"])

@section('mainBody')
    <div class="site-wrap">
        <div class="theme-container">
           <div class="theme-form section-white">
               <div class="col-lg-12">
                    <div class="theme-header-block">
                        <img src="{{asset('public')}}/img/new-user.svg" class="heading-icon">
                        <h2 class="theme-header">Registration</h2>
                    </div>  
                </div>
                <div class="col-lg-10 col-md-10 center-block">
                    {!! Form::open(['route'=> ['userregister'],'method' => 'POST','class'=>'form-horizontal','name'=>'register'] ) !!}
                        <section class="theme-form-section">
                            <h3 class="section-head text-center">Enter Your Details Here</h3>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="f_name" class="col-sm-5 control-label">First Name<span class="mandatory">*</span> :
                                    </label>
                                    <div class="col-sm-7 {{ $errors->has('f_name') ? ' has-error' : '' }}">
                                        {{ Form::text('f_name',null, ['class'=> 'form-control','placeholder'=>'Enter First Name','id'=>'f_name','data-bvalidator'=>"required,maxlength[50]"]) }}
                                        @if ($errors->has('f_name'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('f_name') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="l_name" class="col-sm-5 control-label">Last Name<span class="mandatory">*</span> :</label>
                                    <div class="col-sm-7 {{ $errors->has('l_name') ? ' has-error' : '' }}">
                                        {{ Form::text('l_name',null, ['class'=> 'form-control','placeholder'=>'Enter Last Name','id'=>'l_name','data-bvalidator'=>"required,maxlength[50]"]) }}
                                        @if ($errors->has('l_name'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('l_name') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="col-sm-5 control-label">Email Address<span class="mandatory">*</span> :</label>
                                    <div class="col-sm-7 {{ $errors->has('email') ? ' has-error' : '' }}">
                                        {{ Form::text('email',null, ['class'=> 'form-control','placeholder'=>'Enter Email Address','id'=>'email','data-bvalidator'=>"required,email,maxlength[80]"]) }}
                                        @if ($errors->has('email'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-5 control-label">Mobile Number</label>
                                    <div class="col-sm-7 {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                        {{ Form::text('mobile',null, ['class'=> 'form-control','placeholder'=>'Enter mobile Address','id'=>'mobile','maxlength'=>10,'data-bvalidator'=>"number,minlength[10]"]) }}
                                        @if ($errors->has('mobile'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="col-sm-5 control-label">Password<span class="mandatory">*</span> :</label>
                                    <div class="col-sm-7 {{ $errors->has('password') ? ' has-error' : '' }}">
                                        {{ Form::password('password', ['class'=> 'form-control','placeholder'=>'Enter Password','id'=>'password','data-bvalidator'=>"required,minlength[6],maxlength[80]"]) }}
                                        @if ($errors->has('password'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">                     
                                <div class="form-group">
                                    <label for="password" class="col-sm-5 control-label">Confirm Password<span class="mandatory">*</span> :</label>
                                    <div class="col-sm-7 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        {{ Form::password('password_confirmation', ['class'=> 'form-control','placeholder'=>'Enter Password Again','id'=>'password_confirmation','data-bvalidator'=>"required,equalto[password]"]) }}
                                        @if ($errors->has('password_confirmation'))
                                            <p class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </section>
                        <div class="button-block text-center btn-padding">
                            <button id="submit" type="submit" value="Submit" class="btn btn-orange btn-theme btn-lg">Submit</button>
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="clearfix"></div>
           </div>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">

</script>
@endsection