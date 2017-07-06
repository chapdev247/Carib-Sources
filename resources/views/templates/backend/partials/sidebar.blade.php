<?php
$cur_route = Route::currentRouteName();
$dashboard = ($cur_route == 'admin.dashboard')?'active':'';
$users = ($cur_route == 'CmsController.getusers')?'active':'';
$categories = ($cur_route == 'categories.index' || $cur_route == 'categories.create' || $cur_route == 'categories.edit')?'active':'';
$categories_list = ($cur_route == 'categories.index' || $cur_route == 'categories.edit')?'active':'';
$categories_add = ($cur_route == 'categories.create')?'active':'';
$products = ($cur_route == 'products.index' || $cur_route == 'products.edit')?'active':'';

?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search " action="#" method="POST">
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="{{$dashboard}}">
                <a href="{{route('admin.dashboard')}}">
                <i class="icon-home"></i>
                <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="{{$users}}">
                <a href="{{route('CmsController.getusers')}}">
                <i class="fa fa-users"></i> 
                <span class="title">User Management</span>
                </a>
            </li>
            <li class="{{$categories}}">
                <a href="javascript:;">
                <i class="fa fa-building" aria-hidden="true"></i>
                <span class="title">Category Management</span>
                <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{$categories_list}}">
                        <a href="{{route('categories.index')}}">
                        <i class="icon-bar-chart"></i>
                        Category List</a>
                    </li>
                    <li class="{{$categories_add}}">
                        <a href="{{route('categories.create')}}">
                        <i class="icon-bulb"></i>
                        Add Category</a>
                    </li>
                </ul>
            </li>
            <li class="{{$products}}">
                <a href="{{route('products.index')}}">
                <i class="fa fa-cubes"></i> 
                <span class="title">Product Management</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>