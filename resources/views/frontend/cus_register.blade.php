@extends('templates/frontend/layout')
@section('title','| Custom Registration')

@section('mainBody')
    <div class="message_div">
    </div>
    <div class="container">
        <div class="row loader_wrap">
            <div class="section_loader" id="search_loader">
                <img src="http://205.134.251.196/~examin8/CI/cart_stat/ng_assets/images/loading-new.gif" alt="Loading.." />
            </div> 
            <div class="stepwizard col-md-offset-3">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                        <p>Step 1</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                        <p>Step 2</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                        <p>Step 3</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                        <p>Step 4</p>
                    </div>
                </div>
            </div>
            
            {!!  Form::open( array('name'=>'cusRegisterForm', 'files'=>true,'id'=>'invite-form') ) !!}
                <div class="row setup-content" id="step-1">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 1</h3>
                      <div class="form-group">
                        <label class="control-label">First Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" name="f_name" />
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Last Name</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" name="l_name" />
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Email</label>
                        <input maxlength="100" type="email" required="required" class="form-control" placeholder="Enter Email Address" name="email" />
                        <p class="text-danger"></p>
                      </div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" id="step-2">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 2</h3>
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your address" name="address" ></textarea>
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">City</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter City" name="city" />
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Zip Code</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Zip Code" name="zip" />
                        <p class="text-danger"></p>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" id="step-3">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 3</h3>
                      <div class="form-group">
                        <label class="control-label">Company Name</label>
                        <input maxlength="50" type="text" required="required" class="form-control" placeholder="Enter Company Name" name="c_name" />
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your Company Address" name="c_address"></textarea>
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company City</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company City" name="c_city" />
                        <p class="text-danger"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Zip Code</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company Zip Code" name="c_zip" />
                        <p class="text-danger"></p>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" id="step-4">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 4</h3>
                      <div class="form-group">
                        <label class="control-label">Upload file</label>
                        <input type="file" class="form-control" name="i_file" />
                        <p class="text-danger"></p>
                      </div>
                      <p>By clicking "Submit".You will be agree with the terms and conditions of this website.</p>
                      <button class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                    </div>
                  </div>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($) {
        var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');
        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
            $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('.form-control:eq(0)').focus();
            }
        });
      
        allPrevBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
            prevStepWizard.removeAttr('disabled').trigger('click');
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='url'],textarea"),
            isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }
            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });
        $('div.setup-panel div a.btn-primary').trigger('click');
        $("form[name='cusRegisterForm']").submit(function (e) {
            e.preventDefault();
            $(".section_loader").show();
            var form = $(this);
            var form_data = form.serializeArray();
            var formData = new FormData(form[0]);
            /*if ($('input[type=file]')[0].files>0) 
                formData.append("i_file",$('input[type=file]')[0].files[0]);*/
            $("p.text-danger").each(function() {
                $(this).html('');
            });
            $.ajax({
                type:'POST',
                url:"{{ route('postcusregister') }}",
                data:formData,
                async: false,
                success:function(response){
                    $(".message_div").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.data+'</div>');
                    form[0].reset();
                    navListItems.removeClass('btn-primary').addClass('btn-default').attr('disabled', 'disabled');
                    $("a[href='#step-1']").addClass('btn-primary').removeAttr('disabled');
                    allWells.hide();
                    $("#step-1").show();
                    $(".section_loader").hide();
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (err) {
                    //console.log(err.responseJSON);
                    var to_show = "";
                    $.each(err.responseJSON, function( index, value ) {
                        var error = '';
                        $.each(value, function( i_index, i_value ) {
                            error = error + i_value + "<br>";
                        });
                        if (to_show=="") {
                            to_show = index;
                        }
                        form.find('[name='+index+']').next("p").html(error);
                    });
                    if (to_show!="") {
                        var div = $('[name='+to_show+']').parents('div.setup-content');
                        if (div!='Undefined') {
                            var $target = $("#"+div.attr('id'));
                            var $item = $('a[href="'+"#"+div.attr('id')+'"]');
                            navListItems.removeClass('btn-primary').addClass('btn-default');
                            $item.addClass('btn-primary');
                            allWells.hide();
                            $target.show();
                        }
                    }
                    $(".section_loader").hide();
                }
            });
        });
    });
</script>
@endsection
<style type="text/css">
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 50%;
        position: relative;
    }
    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }
    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    a[disabled]
    {
        pointer-events: none;
    }
    .loader_wrap{
        position: relative;
    }

    .section_loader{
        display: none;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255,255,255,0.8);
        z-index: 9;
        text-align: center;
    }

    .section_loader img{
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -50px;
        height: 100px;
        margin-top: -50px;
        width: 100px;
    }
</style>