<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.html">
            <img src="{{asset('public/')}}/theme/assets/admin/layout/img/logo.png" alt="logo" class="logo-default"/>
            </a>
            <div class="menu-toggler sidebar-toggler hide">
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <img alt="" class="img-circle" src="{{asset('public/')}}/theme/assets/admin/layout/img/avatar.png"/>
                    <span class="username username-hide-on-mobile">{{ Auth::user()->name }} </span>
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ route('CmsController.getprofile',Auth::user()->id) }}">
                            <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
                            7 </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fa fa-gear fa-fw"></i> Settings
                            </a>
                        </li>
                        <li class="divider">
                        </li>
                        <li>
                            <a href="{{ route('admin.logout') }}">
                                <i class="icon-logout"></i></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
