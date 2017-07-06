<!DOCTYPE html>
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{asset('public/')}}/theme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="{{asset('public/')}}/theme/assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{asset('public/')}}/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="{{asset('public/')}}/theme/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{asset('public/')}}/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
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
<!-- END THEME STYLES -->
<link rel="shortcut icon" href=""/>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">