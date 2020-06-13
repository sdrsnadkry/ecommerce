<!--Header-part-->
<div id="header">

    <h1><a href="{{ url('/admin/dashboard') }}">E-SHOPPER ADMIN</a></h1>
</div>
<!--close-Header-part-->
<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav" id="headicon">
        <li class="dropdown" id="profile-messages"><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user" style="color:#fff;"></i> <span class="text">&nbsp;&nbsp;{{Session::get('adminSession', 'username')}}&nbsp;&nbsp;</span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('admin/settings') }}"><i class="icon-user"></i> My Profile</a></li>
                <li class="divider"></li>
                <li class="divider"></li>
                <li><a href="{{ url('logout') }}"><i class="icon-key"></i> Log Out</a></li>
            </ul>
        </li>

    </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
    <button class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
    <input type="text" placeholder="Search here..." />
</div>