@extends('templates/frontend/layout')
@section('title',$data["title"])
@section('stylesheets')
	<style type="text/css">
		.btn-addproduct{
			position: absolute;
		    right: 0px;
		    top: 28px;
		}
		.image_container {
		    margin-bottom: 10px;
		    position: relative;
		}

		.image {
		  opacity: 1;
		  display: block;
		  height: auto;
		  transition: .5s ease;
		  backface-visibility: hidden;
		}

		.middle {
		  transition: .5s ease;
		  opacity: 0;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%)
		}

		.image_container:hover .image {
		  opacity: 0.3;
		}

		.image_container:hover .middle {
		  opacity: 1;
		}
	</style>
@endsection
@section('mainBody')
<div class="site-wrap">
	<div class="theme-container">
		<div class="row dashboard-page">
		    <div class="col-md-12">
			 <div class="dashboard-user-info section-white clearfix">
				<p class="pull-left"><img src="{{asset('public')}}/img/user-icon.svg" width="20" class="icon"> &nbsp;&nbsp;Welcome to your dashboard <font color="#ff6a00">{{Auth::user()->f_name." ".Auth::user()->l_name}}</font></p>
				<span class="pull-right">
					<a href="#" class="btn btn-membership">Get Premium Membership  </a>
				</span>
			 </div>
			</div>	
			<div class="col-md-3">
				<div class="dashboard-left section-white">
				 <header><i class="fa fa-list-ul" aria-hidden="true"></i> Menu</header>
				  <ul class="dashboard-menu">
				    <li><a href="{{ route('dashboard') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Dashboard</a></li>
				    <li><a href="{{ route('dashboard','products') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Manage Product</a></li>
					<li><a href="{{ route('dashboard','products') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Post Requirment</a></li>	
				  	<li><a href="{{ route('dashboard','profile') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Profile</a></li>
				  	<li><a href="{{ route('dashboard','products') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Company Profile</a></li>
				  	<li><a href="{{ route('dashboard','products') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Settings</a></li>
				  	<li><a href="{{ route('dashboard','products') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Change Password</a></li>
				  	<li><a href="{{ route('logout') }}"><img src="{{asset('public')}}/img/next-arrow.svg" width="20">Logout</a></li>
				  </ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="dashboard-right section-white">
					@if($data["page"]=='products')
						@if($data["action"]=='add')
							@include('frontend/dashboard/addproduct')
						@elseif($data["action"]=='edit')
							@include('frontend/dashboard/editproduct')
						@else
							@include('frontend/dashboard/listproduct')
						@endif
					@elseif($data["page"]=='profile')
						@include('frontend/dashboard/profile')
					@elseif($data["page"]=='company-profile')
						@include('frontend/dashboard/company-profile')
				    @else
				    	<h2 class="heading">Dashboard</h2>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	@yield('innerscripts')
@endsection