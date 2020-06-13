@extends('layouts.adminLayout.admin_design')
@section('content')
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    @if(Session::has('flash_message_error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">X</button>
        <strong>
            {!! session('flash_message_error') !!}
        </strong>
    </div>
    @endif
    @if(Session::has('flash_message_success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">X</button>
        <strong>
            {!! session('flash_message_success') !!}
        </strong>
    </div>
    @endif
    <!--End-breadcrumbs-->
    <!--Action boxes-->
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <ul class="quick-actions">
                <li class="bg_lb"> <a href="{{url('/admin/dashboard')}}"> <i class="icon-dashboard"></i> <span class="label label-important"></span> My Dashboard </a> </li>
                @if(Session::get('adminDetails')['categories_access']==1)
                <li class="bg_ly"> <a href="{{url('/admin/view-categories')}}"> <i class="icon-list"></i><span class="label label-success">{{$categoryCount}}</span> Categories </a> </li>
                @endif
                @if(Session::get('adminDetails')['products_access']==1)
                <li class="bg_lg span3"> <a href="{{url('/admin/view-products')}}"> <i class="icon-tags"></i><span class="label label-success">{{$productCount}}</span> Products</a> </li>
                @endif
                @if(Session::get('adminDetails')['banners_access']==1)
                <li class="bg_lo"> <a href="{{url('/admin/view-banners')}}"> <i class="icon-camera"></i><span class="label label-success">{{$bannerCount}}</span> Banners</a> </li>
                @endif
                @if(Session::get('adminDetails')['brands_access']==1)
                <li class="bg_ls"> <a href="{{url('/admin/view-brands')}}"> <i class="icon-film"></i><span class="label label-success">{{$brandsCount}}</span> Brands</a> </li>
                @endif
                @if(Session::get('adminDetails')['orders_access']==1)
                <li class="bg_lo span3"> <a href="{{url('/admin/view-orders')}}"> <i class="icon-shopping-cart"></i><span class="label label-success">{{$orderCount}}</span> Orders</a> </li>
                @endif
                @if(Session::get('adminDetails')['users_access']==1)
                <li class="bg_ls"> <a href="{{url('/admin/view-users')}}"> <i class="icon-user"></i><span class="label label-success">{{$usersCount}}</span> Users</a> </li>
                @endif
                @if(Session::get('adminDetails')['cms_pages_access']==1)
                <li class="bg_lb"> <a href="{{url('/admin/view-cms-pages')}}"> <i class="icon-phone"></i><span class="label label-success">{{$cmsCount}}</span> CMS Pages</a> </li>
                @endif
                @if(Session::get('adminDetails')['inquiries_access']==1)
                <li class="bg_lr span3"> <a href="{{url('/admin/view-inquiry')}}"> <i class="icon-envelope"></i><span class="label label-success">{{$inquiriesCount}}</span> Inquiries</a> </li>
                @endif
            </ul>
        </div>
        <!--End-Action boxes-->
        <!--Chart-box-->
        <div class="row-fluid">
            <div class="widget-box">
               
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span9">
                            
                        </div>
                        <div class="span3">
                            <ul class="site-stats">
                                <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong> <small>Total Users</small></li>
                                <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong> <small>New Users </small></li>
                                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>656</strong> <small>Total Shop</small></li>
                                <li class="bg_lh"><i class="icon-tag"></i> <strong>9540</strong> <small>Total Orders</small></li>
                                <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong> <small>Pending Orders</small></li>
                                <li class="bg_lh"><i class="icon-globe"></i> <strong>8540</strong> <small>Online Orders</small></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End-Chart-box-->
        <hr />
        <div class="row-fluid">
            <div class="span6">
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part-->
@endsection
