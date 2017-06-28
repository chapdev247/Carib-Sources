@extends('templates/frontend/layout')
@section('title','| Form Page')

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
                    <div class="stepwizard-step">
                        <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                        <p>Step 5</p>
                    </div>
                </div>
            </div>
            {!!  Form::open( array('name'=>'cusRegisterForm', 'files'=>true,'id'=>'invite-form','novalidate'=>'') ) !!}
                <div class="row setup-content" id="step-1">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        <h3> Step 1</h3>
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
                            <label class="control-label">Address</label>
                            <textarea required="required" class="form-control" placeholder="Enter your address" name="address">test address this is...</textarea>
                            <p class="text-danger address"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">City</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter City" name="city" value="indore" />
                            <p class="text-danger city"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Zip Code</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Zip Code" name="zip" value="328001" />
                            <p class="text-danger zip"></p>
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
                        <label class="control-label">Company Name</label>
                        <input maxlength="50" type="text" required="required" class="form-control" placeholder="Enter Company Name" name="c_name" value="test company" />
                        <p class="text-danger c_name"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your Company Address" name="c_address">test company address</textarea>
                        <p class="text-danger c_address"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company City</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company City" name="c_city" value="test city" />
                        <p class="text-danger c_city"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Zip Code</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company Zip Code" name="c_zip" value="402015" />
                        <p class="text-danger c_zip"></p>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Preferred Tag</label>
                        @if (!empty($ftags))
                            <div class="tags_div">
                                @foreach ($ftags as $ftag)
                                    <input type="checkbox" required="required" class="tags" name="ftags[{{$ftag->id}}]" value="1" checked="" />{{$ftag->name}}
                                @endforeach
                            </div>
                        @endif
                        <p class="text-danger ftags"></p>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#myModal"> Add Tag <i class="fa fa-plus" aria-hidden="true"></i></button>
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
                            <h4>Your Pricing?</h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Your Daily Price</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                           <input type="text" required="required" class="form-control" name="daily_from" value="10" />
                                            <p class="text-danger daily_from"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" name="daily_to" value="20" />
                                            <p class="text-danger daily_to"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Your Monthly Price</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                           <input type="text" required="required" class="form-control" name="monthly_from" value="200" />
                                            <p class="text-danger monthly_from"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" name="monthly_to" value="300" />
                                            <p class="text-danger monthly_to"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="control-label">Your Yearly Price</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                           <input type="text" required="required" class="form-control" name="yearly_from" value="2000" />
                                            <p class="text-danger yearly_from"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" name="yearly_to" value="3000" />
                                            <p class="text-danger yearly_to"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <h4>How Long?</h4>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Start Date</label>
                            <input type="date" class="form-control" name="start" value="2017-06-18" />
                            <p class="text-danger start"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">End Date</label>
                            <input type="date" class="form-control" name="end" value="2017-06-22" />
                            <p class="text-danger end"></p>
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
                        <input type="file" class="form-control" name="image" />
                        <p class="text-danger image"></p>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" id="step-5">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 5</h3>
                      <p>By clicking "Submit".You will be agree with the terms and conditions of this website.</p>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                      <button  class="btn btn-success btn-lg pull-right" type="submit">Submit</button>
                    </div>
                  </div>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        {!!  Form::open(array('name'=>'add_form'))  !!}
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add tag</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label" for="tag_name">Tag name</label>    
                </div>
                <div class="col-md-8">
                    <input type="text" name="tag_name" id="tag_name" class="form-control" placeholder="Enter Tag Name">
                    <p class="text-danger tag_name"></p>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary submit_tag_form" type="button">Add Tag</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
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
            $(".section_loader").show();
            var allInputs = "input[type='text'],input[type='email'],input[type='url'],textarea,input[type='checkbox'],input[type='date'],input[type='file']";
            var form = $("form[name='cusRegisterForm']");
            //form.find(allInputs).not(':visible').prop('disabled', true);
            var formData = new FormData(form[0]);
            //form.find(allInputs).not(':visible').removeProp('disabled');
            var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a");
            $("p.text-danger").each(function() {
                $(this).html('');
            });
            //var formData = new FormData();
            formData.append("step",curStepBtn);
            formData.append("_token",$("[name='_token']").val());
            $.ajax({
                type:'POST',
                url:"{{ route('postcusform') }}",
                data:formData,
                async: false,
                success:function(response){
                    //console.log(response.data);
                    nextStepWizard.removeAttr('disabled').trigger('click');
                    $(".section_loader").hide();
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (err) {
                    var to_show = "";
                    $.each(err.responseJSON, function( index, value ) {
                        var error = '';
                        $.each(value, function( i_index, i_value ) {
                            error = error + i_value + "<br>";
                        });
                        if (to_show=="") {
                            to_show = index;
                        }
                        $("p.text-danger."+index+"").html(error);
                    });
                    if (to_show!="") {
                        var div = $('.text-danger.'+to_show+'').parents('div.setup-content');
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
        $('div.setup-panel div a.btn-primary').trigger('click');
        $("form[name='cusRegisterForm']").submit(function (e) {
            e.preventDefault();
            $(".section_loader").show();
            var form = $(this);
            //var formData = form.serializeArray();
            var formData = new FormData(form[0]);
            formData.append('step','last');
            $("p.text-danger").each(function() {
                $(this).html('');
            });
            $.ajax({
                type:'POST',
                url:"{{ route('postcusform') }}",
                data:formData,
                async: false,
                success:function(response){
                    //console.log(response);
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
        $(".submit_tag_form").click(function(e) {
            var form = $("form[name='add_form']");
            //var formData = form.serializeArray();
            var formData = new FormData(form[0]);
            formData.append("step",'tag_name');
            /*if ($('input[type=file]')[0].files>0) 
                formData.append("i_file",$('input[type=file]')[0].files[0]);*/
            $.ajax({
                type:'POST',
                url:"{{ route('postcusform') }}",
                data:formData,
                async: false,
                success:function(response){
                    $(".message_div").html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>'+response.data.message+'</div>');
                    $(".tags_div").append('<input type="checkbox" required="required" class="tags" name="ftags['+response.data.id+']" value="1" checked="" />'+response.data.name+'');
                    $('#myModal').modal('toggle');
                    $("[name='tag_name']").val('');
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (err) {
                    $.each(err.responseJSON, function( index, value ) {
                        var error = '';
                        $.each(value, function( i_index, i_value ) {
                            error = error + i_value + "<br>";
                        });
                        $("p.text-danger."+index+"").html(error);
                    });
                }
            });
            e.preventDefault();
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