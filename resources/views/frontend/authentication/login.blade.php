@extends('templates/frontend/layout')
@section('title',$data["title"])

@section('mainBody')
<div class="site-wrap">
    <div class="theme-container">
       <div class="theme-form section-white">
            {!! Form::open(['route'=> ['userlogin'],'method' => 'POST','class'=>'form-horizontal','name'=>'login'] ) !!}
                <div class="col-md-6 col-sm-6 col-lg-6 login-section">
                    <div class="theme-header-block">
                        <img src="{{asset('public')}}/img/padlock.svg" class="heading-icon">
                        <h2 class="theme-header">Login</h2>
                    </div>
                    <section class="theme-form-section">
                        <h3 class="section-head text-center">Enter Your Details Here</h3>
                        <div class="form-group clearfix {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 control-label">Email Id<span class="mandatory">*</span> :</label>
                            <div class="col-sm-6">
                                {{ Form::text('email',null, ['class'=> 'form-control','placeholder'=>'Enter Email Address','id'=>'email','data-bvalidator'=>"required,email,maxlength[80]"]) }}
                                @if ($errors->has('email'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group clearfix {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Password<span class="mandatory">*</span> :</label>
                            <div class="col-sm-6">
                                {{ Form::password('password', ['class'=> 'form-control','placeholder'=>'Enter Password','id'=>'password','data-bvalidator'=>"required,minlength[6],maxlength[80]"]) }}
                                @if ($errors->has('password'))
                                    <p class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="button-block">
                           <div>
                              <div class="col-sm-4"></div>
                              <div class="col-md-8">
                                <button id="submit" type="submit" value="Submit" class="btn btn-orange btn-lg">Submit</button>
                                 <a href="{{ route('fogotpassword') }}" class="forgot-link">Forgot Password?</a>
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 register-section">
                    <div class="theme-header-block">
                        <img src="{{asset('public')}}/img/new-user.svg" class="heading-icon">
                        <h2 class="theme-header">Registration</h2>
                    </div>               
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                    <p> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with Ipsum.</p> 
                    <br><br><br>            
                    <div><a href="{{ route('register') }}" class="btn btn-orange btn-lg">Registration</a></div>
                </div>
                <div class="clearfix"></div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div>
</div>  
@endsection
@section('scripts')
<script type="text/javascript">
    
</script>
@endsection