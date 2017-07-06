<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('public')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/slick.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/animate.min.css" rel="stylesheet">
    <link href="{{asset('public')}}/css/bvalidator.css" rel="stylesheet">
    <style type="text/css">
      .section_loader {
          position: absolute;
          left: 0%;
          top: 0%;
          width: 100%;
          height: 100%;
          background-color: rgba(255,255,255,0.8);
          z-index: 9;
          text-align: center;
          /*transform: translateX(-50%);*/
      }
      .section_loader img {
          position: absolute;
          left: 50%;
          top: 50%;
          margin-left: -50px;
          height: 100px;
          margin-top: -50px;
          width: 100px;
      }
      .loader_wrap {
          position: relative;
      }
    </style>
    @yield("stylesheets")
  </head>
  <body>
  <header class="site-header">
  <div class="header-top clearfix">
   <div class="theme-container">
    <ul class="pull-left no-margin list-inline menu">
     <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> &nbsp;Mail Us : support@caribsources.com</a></li>
     <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +91 123456789</a></li>
    </ul>
    <ul class="pull-right list-inline menu">
      @if (Auth::guard("web")->check())
        <li>
          <a href="#">Hello {{ Auth::user()->f_name }} <i class="fa fa-angle-down arrow"></i></a>
          <ul class="drop-down">
            <li><a href="{{ route('dashboard') }}" rel="nofollow">Dashboard</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
            @if (Auth::guard("admin")->check())
              <li><a href="{{ route('admin.dashboard') }}" target="_blank">Backend</a></li>
            @endif
          </ul>
        </li>
      @else
        <li class="login-link-block">
          <img src="{{asset('public')}}/img/login-user.svg" width="18"> 
          <a href="{{ route('login') }}">Login </a> |
          <a href="{{ route('register') }}">Sign Up</a>
        </li>
      @endif 
    </ul>
   </div>
  </div>
  <div class="header-main">
    <div class="theme-container">
     <div class="row">
      <div class="logo-block col-md-3">
        <a href="{{ url('/') }}"><img src="{{asset('public')}}/img/logo.png"></a>
      </div>
      <div class="col-md-7">
       <div class="top-search-block">
       <div class=""></div>
          <div class="input-group input-group-lg">
          <span class="input-group-addon head-catg-block">
            <div class="dropdown">
              <button class="btn btn-catg dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="fa fa-list" aria-hidden="true"></i> Categories
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>
              <a href="product-list.php">Agriculture
              </a>
                <ul>
                  <li><a href="">first</a></li>
                  <li><a href="">second</a></li>
                  <li><a href="">third</a></li>
                </ul>
            </li>
            <li><a href="product-list.php">Apparel &amp; Fashion</a></li>
            <li><a href="product-list.php">Automobile</a></li>
            <li><a href="product-list.php">Brass Hardware &amp; Components</a></li>
            <li><a href="product-list.php">Business Services</a></li>
            <li><a href="product-list.php">Chemicals</a></li>
            <li><a href="product-list.php">Computer Hardware &amp; Software</a></li>
            <li><a href="product-list.php">Construction &amp; Real Estate</a></li>
            <li><a href="product-list.php">Consumer Electronics</a></li>
            <li><a href="product-list.php">Electronics &amp; Electrical Supplies</a></li>
            <li><a href="product-list.php">Energy &amp; Power</a></li>
            <li><a href="product-list.php">Environment &amp; Pollution</a></li>
            <li><a href="product-list.php">Food &amp; Beverage</a></li>
            <li><a href="product-list.php">All Categories</a></li>
              </ul>
            </div>
          </span>
            <input type="text" class="form-control" placeholder="Search For Product" aria-describedby="sizing-addon1">
            <span class="input-group-addon" id="sizing-addon1"><button class="btn btn-search"><img src="{{asset('public')}}/img/magnifying-glass.svg" width="25"> Search</button></span>
          </div>
        </div>
      </div>
      <div class="col-md-2 ">
        <a href="login.php" class="btn btn-theme btn-post">Post Buy Requirement</a>
      </div>
      <div class="clearfix"></div>
     </div>
    </div>
  </div>
  </header>