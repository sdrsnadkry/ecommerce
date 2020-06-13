@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Admins / Sub-Admins </a> </div>
        <h1>Admins / Sub-Admins</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
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
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Add Admin / Sub-Admin</h5>
                    </div>
                    <div class="widget-content padding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-admin') }}" name="add_admin" id="add_admin" novalidate="novalidate">
                            {{  csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Admin / Sub-Admin Type</label>
                                <div class="controls">
                                    <select name="type" id="type" style="width: 220px">
                                        <option value="Admin">Admin</option>
                                        <option value="Sub-Admin">Sub-Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">UserName</label>
                                <div class="controls">
                                    <input type="text" name="username" id="username" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" name="password" id="password" rows="4" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Active/Inactive</label>
                                <div class="controls">
                                    <input type="checkbox" name="status" id="status" value="1">
                                </div>
                            </div>
                            
                            {{-- <div class="remove-later">
                                <div class="control-group">
                                <label class="control-label">Access</label>

                                    
                                    <div class="controls">
                                        <input type="checkbox" name="categories_access" id="categories_access" value="1">&nbsp;&nbsp;Categories&nbsp;&nbsp;
                                        <input type="checkbox" name="products_access" id="products_access" value="1">&nbsp;&nbsp;Products&nbsp;&nbsp;
                                        <input type="checkbox" name="orders_access" id="orders_access" value="1">&nbsp;&nbsp;Orders&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="users_access" id="users_access" value="1">&nbsp;&nbsp;Users&nbsp;&nbsp; <br>
                                        <input type="checkbox" name="banner_access" id="banner_access" value="1">&nbsp;&nbsp;Banners&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="brand_access" id="brand_access" value="1">&nbsp;&nbsp;Brands&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" name="cms_pages_access" id="cms_pages_access" value="1">&nbsp;&nbsp;CMS Pages&nbsp;&nbsp;
                                        <input type="checkbox" name="inquiries_access" id="inquiries_access" value="1">&nbsp;&nbsp;Inquiries&nbsp;&nbsp;
                                    </div>
                                   
                                        
                                </div>

                            </div> --}}

                            <div class="widget-box hidden" id="permissions">
                                <div class="widget-title"> <span class="icon"> <i class="icon-check"></i> </span>
                                    <h5>PERMISSIONS</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="control-label">Categories</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="categories_access" id="categories_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">Products</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="products_access" id="products_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">Orders</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="orders_access" id="orders_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">Users</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="users_access" id="users_access" value="1">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="control-label">Banners</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="banners_access" id="banners_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">Brands</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="brands_access" id="brands_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">CMS Pages</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="cms_pages_access" id="cms_pages_access" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <label class="control-label">Inquiries</label>
                                                    <div class="controls">
                                                        <input type="checkbox" name="inquiries_access" id="inquiries_access" value="1">
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" value="Add Admin" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection