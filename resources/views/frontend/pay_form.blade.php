@extends('templates/frontend/layout')
@section('title','| Form Page')

@section('mainBody')
    <div class="message_div">
    </div>
    <div class="container">
        <div class="row loader_wrap">
            <div class="section_loader" id="search_loader" style="display: none;">
                <img src="http://205.134.251.196/~examin8/CI/cart_stat/ng_assets/images/loading-new.gif" alt="Loading.." />
            </div> 
            {!!  Form::open( array('name'=>'pay_form', 'files'=>true,'id'=>'invite-form','novalidate'=>'') ) !!}
                <div class="row setup-content" id="step-1">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" name="f_name" value="Dewanshu" />
                                    <p class="text-danger f_name"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" name="l_name" value="Sharma" />
                                    <p class="text-danger l_name"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input maxlength="100" type="email" required="required" class="form-control" placeholder="Enter Email Address" name="email" value="mail@example.com" />
                            <p class="text-danger email"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Employment Type</label>
                            <select name="emp_type">
                                <option value="">Select Type of Employment</option>
                                <option value="1">Daily</option>
                                <option value="2">Monthly</option>
                                <option value="3">Yearly</option>
                            </select>
                            <p class="text-danger emp_type"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Employee</label>
                            @foreach ($custs as $employee)
                                <input type="radio" name="employee" value="{{$employee->id}}">{{$employee->f_name}} {{$employee->f_name}}
                            @endforeach
                            <p class="text-danger emp_type"></p>
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Submit</button>
                    </div>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($) {

    });
</script>
@endsection
<style type="text/css">

</style>