@php
$url = url()->current();
@endphp

<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
      <li @if(preg_match("/dashboard/i",$url))  class="active" @endif ><a href="{{url('/admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

      @if(Session::get('adminDetails')['categories_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">+</span></a>        
        <ul @if(preg_match("/categor/i",$url)) style="display:block" @endif>
        <li @if(preg_match("/add-categor/i",$url))  class="active" @endif><a href="{{ url('/admin/add-category') }}">Add Categories</a></li>
          <li @if(preg_match("/view-categor/i",$url))  class="active" @endif><a href="{{ url('/admin/view-categories') }}">View Categories</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['products_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-tags"></i> <span>Products</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/product/i",$url)) style="display:block" @endif>
        <li @if(preg_match("/add-product/i",$url))  class="active" @endif><a href="{{ url('/admin/add-product') }}">Add Product</a></li>
          <li  @if(preg_match("/view-product/i",$url))  class="active" @endif><a href="{{ url('/admin/view-products') }}">View Products</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['banners_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-camera"></i> <span>Banners</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/banner/i",$url)) style="display:block" @endif>
        <li  @if(preg_match("/add-banner/i",$url))  class="active" @endif><a href="{{ url('/admin/add-banner') }}">Add Banner</a></li>
          <li  @if(preg_match("/view-banner/i",$url))  class="active" @endif><a href="{{ url('/admin/view-banners') }}">View Banners</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['brands_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-film"></i> <span>Brands</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/brand/i",$url)) style="display:block" @endif>
        <li  @if(preg_match("/add-brand/i",$url))  class="active" @endif><a href="{{ url('/admin/add-brand') }}">Add Brand</a></li>
          <li  @if(preg_match("/view-brand/i",$url))  class="active" @endif><a href="{{ url('/admin/view-brands') }}">View Brands</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['orders_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-shopping-cart"></i> <span>Orders</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/order/i",$url)) style="display:block" @endif>
          <li  @if(preg_match("/view-order/i",$url))  class="active" @endif><a href="{{ url('/admin/view-orders') }}">View Orders</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['users_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Users</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/user/i",$url)) style="display:block" @endif>
          <li  @if(preg_match("/view-user/i",$url))  class="active" @endif><a href="{{ url('/admin/view-users') }}">View Users</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['type']=="Admin")
      <li class="submenu"> <a href="#"><i class="icon icon-cogs"></i> <span>Admins </span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/-admin/i",$url)) style="display:block" @endif>
        <li  @if(preg_match("/add-admin/i",$url))  class="active" @endif><a href="{{ url('/admin/add-admin') }}">Add Admin</a></li>
          <li  @if(preg_match("/view-admin/i",$url))  class="active" @endif><a href="{{ url('/admin/view-admins') }}">View Admins</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['cms_pages_access']==1)
      <li class="submenu"> <a href="#"><i class="icon icon-phone"></i> <span>CMS Pages</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/cms/i",$url)) style="display:block" @endif>
        <li @if(preg_match("/add-cms/i",$url))  class="active" @endif><a href="{{ url('/admin/add-cms-page') }}">Add CMS PAGE</a></li>
          <li  @if(preg_match("/view-cms/i",$url))  class="active" @endif><a href="{{ url('/admin/view-cms-pages') }}">View CMS Pages</a></li>
        </ul>
      </li>
      @endif
      @if(Session::get('adminDetails')['inquiries_access']==1)
      <li class="submenu"> <a href="#"><i class="icon-envelope-alt"></i> <span>Inquiries</span> <span class="label label-important">+</span></a>
        <ul @if(preg_match("/enq/i",$url)) style="display:block" @endif>
          <li  @if(preg_match("/view-enq/i",$url))  class="active" @endif><a href="{{ url('/admin/view-inquiry') }}">View Inquiries</a></li>
        </ul>
      </li>
      @endif
      
      
      <li class="content"> <span>Learning Laravel</span>
        <div class="progress progress-mini active progress-striped">
          <div style="width: 20%;" class="bar"></div>
        </div>
      
        <span class="percent">20%</span>
        <div class="stat">Begineer / Full Course</div>
      </li>

    </ul>
  </div>
  <!--sidebar-menu-->