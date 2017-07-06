@extends('templates/frontend/layout')
@section('title',$data["title"])

@section('mainBody')
<div class="site-wrap">
    <div class="theme-container">
       <div class="theme-form section-white">
            {!! Form::open(['route'=> ['userfogotpassword'],'method' => 'POST','class'=>'form-horizontal'] ) !!}
                <div class="col-md-12 col-sm-12 col-lg-12 login-section">
                    <div class="theme-header-block">
                        <img src="{{asset('public')}}/img/padlock.svg" class="heading-icon">
                        <h2 class="theme-header">Forgot Password</h2>
                    </div>
                    <section class="theme-form-section">
                        <h3 class="section-head text-center">Enter Your Details Here</h3>
                        <div class="form-group clearfix {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 control-label">Email Id <span class="mandatory">*</span> :</label>
                            <div class="col-sm-6">
                                {{ Form::text('email',null, ['class'=> 'form-control','placeholder'=>'Enter Email Address','id'=>'email','data-bvalidator'=>"required,email,maxlength[80]"]) }}
                                @if ($errors->has('email'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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