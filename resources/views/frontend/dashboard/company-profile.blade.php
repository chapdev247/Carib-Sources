<h2 class="heading">Manage Company Profile</h2>
{!! Form::open(['route'=> ['profile'],'method' => 'POST','class'=>'form-horizontal','files'=>true,'name'=>'profile'] ) !!}
    <section class="theme-form-section">
       	<div class="col-md-12">
          	<div class="form-group">
				<label for="f_name" class="col-sm-3 control-label">Name <span class="mandatory">*</span><span class="colon">:</span>
				</label>
				<div class="col-sm-6">
					{{Form::text( 'f_name',$data["user"]->f_name,array('class' => 'form-control', 'data-bvalidator'=>"required" ) )}}
                    @if ($errors->first('f_name'))
                        <p class="text-danger">
                            {{ $errors->first('f_name') }}
                        </p>
                    @endif
				</div>
          	</div>
       	</div>
       <div class="col-md-12">
          <div class="form-group">
             	<label for="l_name" class="col-sm-3 control-label">Last Name <span class="mandatory">*</span><span class="colon">:</span></label>
             	<div class="col-sm-6">
	                {{Form::text( 'l_name',$data["user"]->l_name,array('class' => 'form-control', 'data-bvalidator'=>"required" ) )}}
	                @if ($errors->first('l_name'))
	                    <p class="text-danger">
	                        {{ $errors->first('l_name') }}
	                    </p>
	                @endif
             	</div>
          </div>
       </div>
       <div class="clearfix"></div>
       <div class="col-md-12">
          	<div class="form-group">
             	<label for="email" class="col-sm-3 control-label">Email Address <span class="mandatory">*</span><span class="colon">:</span></label>
				<div class="col-sm-6">
		            {{Form::text( 'email',$data["user"]->email,array('class' => 'form-control', 'data-bvalidator'=>"required,email" ) )}}
	                @if ($errors->first('email'))
	                    <p class="text-danger">
	                        {{ $errors->first('email') }}
	                    </p>
	                @endif
	            </div>
          	</div>
       </div>
       <div class="col-md-12">
          <div class="form-group">
             	<label for="mobile" class="col-sm-3 control-label">Mobile Number <span class="colon">:</span></label>
				<div class="col-sm-6">
					{{Form::text( 'mobile',$data["user"]->mobile,array('class' => 'form-control' ) )}}
                    @if ($errors->first('mobile'))
                        <p class="text-danger">
                            {{ $errors->first('mobile') }}
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
</form>
@section('innerscripts')
	<script type="text/javascript">
		$("form[name='profile']").bValidator();
	</script>
@endsection