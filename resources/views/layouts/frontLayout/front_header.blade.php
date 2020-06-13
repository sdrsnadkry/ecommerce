@php
use App\Http\Controllers\Controller;
use App\Product;
$mainCategories = Controller::mainCategories();
if(!empty(Auth::check())){
$user_name = Auth::user()->name;
}
$cartCount = Product::cartCount();
@endphp
<header id="header">
    <!--header-->
    <div class="header_top" style="background: #2c3531">
        <!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +977-9812345678</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            @if(!empty(Auth::check()))
                            <li><a href="{{url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
                            @endif
                            <li><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> Cart <span style="color:#fff"><strong>[{{$cartCount}}]</strong></span> </a></li>
                            @if(empty(Auth::check()))
                            <li><a href="{{url('/login-register')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @else
                            <li><a href="{{url('/account')}}"><i class="fa fa-user"></i>{{$user_name}}</a></li>
                            <li><a href="{{url('/user-logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header_top-->
    <div class="header-middle" style="background: #116466">
        <!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="logo ">
                        <a href="{{ url('/')}}"><img src="{{asset('images/frontend_images/home/logo.png')}}" alt="" /></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class=" " style="padding-top:10px;padding-bottom:25px">
                        <form action="{{url('/search-product')}}" method="POST">
                            {{csrf_field()}}
                            <input id="searchmain" type="text" class="" placeholder="Search Product" name="product" id="" style="padding:15px" />
                            <button id="buttoninside" type="submit" class="btn" style="background: royalblue"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-middle-->
    <div class="header-bottom" style="background: #116466">
        <!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{ url('/')}}" class="">Home</a></li>
                            <li class="dropdown"><a>Products<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    @foreach ($mainCategories as $cat)
                                    @if($cat->status=='1')
                                    <li><a href="{{asset('products/'.$cat->url)}}">{{$cat->name}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/page/contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/header-bottom-->
</header>
