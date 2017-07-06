@extends('templates/frontend/layout')
@section('title',$data["title"])

@section('mainBody')
<div class="site-wrap">
    <div class="theme-container">
        <div class="theme-form section-white">
            {!! Form::open(['route'=> ['userpasswordreset',$data["reset"]->email,$data["reset"]->token],'method' => 'POST','class'=>'form-horizontal'] ) !!}
                <div class="col-md-12 col-sm-12 col-lg-12 login-section">
                    <div class="theme-header-block">
                        <img src="{{asset('public')}}/img/padlock.svg" class="heading-icon">
                        <h2 class="theme-header">Reset Password</h2>
                    </div>
                    <section class="theme-form-section">
                        <h3 class="section-head text-center">Enter Your Details Here</h3>
                        <div class="form-group clearfix {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Passowrd <span class="error">*</span></label>
                            <div class="col-sm-6">
                                {{ Form::password('password', ['class'=> 'form-control','placeholder'=>'Enter Passowrd','id'=>'password']) }}
                                @if ($errors->has('password'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group clearfix {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password_confirmation" class="col-sm-4 control-label">Confim Password <span class="error">*</span></label>
                            <div class="col-sm-6">
                                {{ Form::password('password_confirmation', ['class'=> 'form-control','placeholder'=>'Confirm Password','id'=>'password_confirmation']) }}
                                @if ($errors->has('password_confirmation'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="button-block">
                           <div>
                              <div class="col-sm-4"></div>
                              <div class="col-md-8">
                                <button id="submit" type="submit" value="Submit" class="btn btn-orange btn-lg">Submit</button>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
                <div class="clearfix"></div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div>
</div>  
@endsection