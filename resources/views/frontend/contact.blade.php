@extends('templates/frontend/layout')
@section('title','| Contact Us')

@section('mainBody')
    <div class="jumbotron jumbotron-sm">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <h1 class="h1">
                        Contact us <small>Feel free to contact us</small></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="well well-sm">
                    {!!  Form::open() !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('name','Name: ')}}
                                    {{Form::text( 'name',null,array('class' => 'form-control', 'placeholder'=>'Enter Your name')) }}
                                    @if ($errors->first('name'))
                                        <p class="text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('email','Email Address: ')}}
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        {{Form::text( 'email',null,array('class' => 'form-control', 'placeholder'=>'Enter Your Email') )}}
                                    </div>
                                    @if ($errors->first('email'))
                                        <p class="text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    {{Form::label('subject','Subject: ')}}
                                    {{Form::text( 'subject',null,array('class' => 'form-control', 'placeholder'=>'Subject...') )}}
                                    @if ($errors->first('subject'))
                                        <p class="text-danger">
                                            {{ $errors->first('subject') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{Form::label('message','Message: ')}}
                                    {{Form::textarea( 'message',null,array('class' => 'form-control', 'placeholder'=>'Message...') )}}
                                    @if ($errors->first('message'))
                                        <p class="text-danger">
                                            {{ $errors->first('message') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Send Message</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-4">
                <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                <address>
                    <strong>Twitter, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    <abbr title="Phone">
                        P:</abbr>
                    (123) 456-7890
                </address>
                <address>
                    <strong>Full Name</strong><br>
                    <a href="mailto:#">first.last@example.com</a>
                </address>
            </div>
        </div>  
    </div>
@endsection
@section('scripts')
@endsection