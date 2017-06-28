@extends('templates/frontend/layout')
@section('title','| Form Page')

@section('mainBody')
<div ng-controller="ProjectListController" class="loader_wrap">
    <div class="section_loader" ng-show="search_loader==true">
        <img src="http://205.134.251.196/~examin8/CI/cart_stat/ng_assets/images/loading-new.gif" alt="Loading.." />
    </div> 
    <div class="message_div" ng-if="message">
    </div>
    <div class="container" ng-init="CurStep='1'">
        <div class="row">
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
                <div class="row setup-content" ng-show="CurStep=='1'">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                        !!! modal[1] !!!
                        <h3> Step 1</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" ng-model="modal.f_name" />
                                    <div class="text-danger" ng-show="Error.f_name">
                                        <p ng-repeat="err in Error.f_name">!!! err !!!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Last Name" ng-model="modal.l_name" />
                                    <div class="text-danger" ng-show="Error.l_name">
                                        <p ng-repeat="err in Error.l_name">!!! err !!!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input maxlength="100" type="email" required="required" class="form-control" placeholder="Enter Email Address" ng-model="modal.email" />
                            <div class="text-danger" ng-show="Error.email">
                                <p ng-repeat="err in Error.email">!!! err !!!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <textarea required="required" class="form-control" placeholder="Enter your address" ng-model="modal.address"></textarea>
                            <div class="text-danger" ng-show="Error.address">
                                <p ng-repeat="err in Error.address">!!! err !!!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">City</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter City" ng-model="modal.city" />
                            <div class="text-danger" ng-show="Error.city">
                                <p ng-repeat="err in Error.city">!!! err !!!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Zip Code</label>
                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Zip Code" ng-model="modal.zip" />
                            <div class="text-danger" ng-show="Error.zip">
                                <p ng-repeat="err in Error.zip">!!! err !!!</p>
                            </div>
                        </div>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" ng-click="step(1)">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" ng-show="CurStep=='2'">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 2</h3>
                      <div class="form-group">
                        <label class="control-label">Company Name</label>
                        <input maxlength="50" type="text" required="required" class="form-control" placeholder="Enter Company Name" ng-model="modal.c_name" />
                        <div class="text-danger" ng-show="Error.c_name">
                            <p ng-repeat="err in Error.c_name">!!! err !!!</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company Address</label>
                        <textarea required="required" class="form-control" placeholder="Enter your Company Address" ng-model="modal.c_address" ></textarea>
                        <div class="text-danger" ng-show="Error.c_address">
                            <p ng-repeat="err in Error.c_address">!!! err !!!</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Company City</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company City" ng-model="modal.c_city" />
                        <div class="text-danger" ng-show="Error.c_city">
                            <p ng-repeat="err in Error.c_city">!!! err !!!</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Zip Code</label>
                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Company Zip Code" ng-model="modal.c_zip" />
                        <div class="text-danger" ng-show="Error.c_zip">
                            <p ng-repeat="err in Error.c_zip">!!! err !!!</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Preferred Tag</label>
                        @if (!empty($ftags))
                            <div class="tags_div">
                                @foreach ($ftags as $ftag)
                                    <input type="checkbox" required="required" class="tags" ng-model="modal.ftags[{{$ftag->id}}]" value="1" checked="" />{{$ftag->name}}
                                @endforeach
                            </div>
                        @endif
                        <div class="text-danger" ng-show="Error.ftags">
                            <p ng-repeat="err in Error.ftags">!!! err !!!</p>
                        </div>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#myModal"> Add Tag <i class="fa fa-plus" aria-hidden="true"></i></button>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" ng-click="CurStep=1">Previous</button>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" ng-click="step(2)">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" ng-show="CurStep=='3'">
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
                                           <input type="text" required="required" class="form-control" ng-model="modal.daily_from" />
                                            <div class="text-danger" ng-show="Error.daily_from">
                                                <p ng-repeat="err in Error.daily_from">!!! err !!!</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" ng-model="modal.daily_to" />
                                            <div class="text-danger" ng-show="Error.daily_to">
                                                <p ng-repeat="err in Error.daily_to">!!! err !!!</p>
                                            </div>
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
                                           <input type="text" required="required" class="form-control" ng-model="modal.monthly_from" />
                                           <div class="text-danger" ng-show="Error.monthly_from">
                                                <p ng-repeat="err in Error.monthly_from">!!! err !!!</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" ng-model="modal.monthly_to" />
                                            <div class="text-danger" ng-show="Error.monthly_to">
                                                <p ng-repeat="err in Error.monthly_to">!!! err !!!</p>
                                            </div>
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
                                           <input type="text" required="required" class="form-control" ng-model="modal.yearly_from" />
                                           <div class="text-danger" ng-show="Error.yearly_from">
                                                <p ng-repeat="err in Error.yearly_from">!!! err !!!</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" required="required" class="form-control" ng-model="modal.yearly_to" />
                                            <div class="text-danger" ng-show="Error.yearly_to">
                                                <p ng-repeat="err in Error.yearly_to">!!! err !!!</p>
                                            </div>
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
                            <input type="date" class="form-control" ng-model="modal.start" />
                            <div class="text-danger" ng-show="Error.start">
                                <p ng-repeat="err in Error.start">!!! err !!!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">End Date</label>
                            <input type="date" class="form-control" ng-model="modal.end" />
                            <div class="text-danger" ng-show="Error.end">
                                <p ng-repeat="err in Error.end">!!! err !!!</p>
                            </div>
                        </div>
                        <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" ng-click="CurStep=2">Previous</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" ng-click="step(3)">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" ng-show="CurStep=='4'">
                  <div class="col-xs-6 col-md-offset-3">
                    <div class="col-md-12">
                      <h3> Step 4</h3>
                      <div class="form-group">
                        <label class="control-label">Upload file</label>
                        <input type="file" class="form-control" ng-model="modal.image" />
                        <div class="text-danger" ng-show="Error.image">
                            <p ng-repeat="err in Error.image">!!! err !!!</p>
                        </div>
                      </div>
                      <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" ng-click="CurStep=3">Previous</button>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" ng-click="step(4)">Next</button>
                    </div>
                  </div>
                </div>
                <div class="row setup-content" ng-show="CurStep=='5'">
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
</div>
@endsection
@section('scripts')
<script type="text/javascript">
laraApp.controller('ProjectListController', function($scope,$http) {
    $scope.modal = {};
    $scope.search_loader = false;
    $scope.step = function (step) {
        $scope.Error = {};
        $scope.search_loader = true;
        $scope.modal['step'] = step;
        $http.post("{{ route('postcusform') }}", $scope.modal ).then(function(res)
        {
            if (step==5) {

            }
            else{
                $scope.CurStep = step+1;
            }
            console.log(res);
            $scope.search_loader = false;
        }, function(err) {
            $scope.Error = err.data;
            $scope.search_loader = false;
        });
    }
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