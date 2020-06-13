@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Admins/Sub-Admins</a> </div>
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
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>All Admins/ Sub-Admins</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Admin ID</th>
                                    <th>UserName</th>
                                    <th>Type</th>
                                    <th>Roles</th>
                                    <th>Created On</th>
                                    <th>Updated On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                @php
                                if($admin->type == "Admin"){
                                $roles = "All";
                                }else{
                                $roles = "";
                                if($admin->categories_access == 1){ $roles .= "Categories , "; }
                                if($admin->products_access == 1){ $roles .= "Products ,"; }
                                if($admin->orders_access == 1){ $roles .= "Orders , "; }
                                if($admin->users_access == 1){ $roles .= "Users , "; }
                                if($admin->banners_access == 1){ $roles .= "Banners , "; }
                                if($admin->brands_access == 1){ $roles .= "Brands , "; }
                                if($admin->cms_pages_access == 1){ $roles .= "CMS Pages , "; }
                                if($admin->inquiries_access == 1){ $roles .= "Inquiries "; }
                                }
                                @endphp
                                <tr class="gradeX">
                                    <td>{{ ucfirst($admin->id)}}</td>
                                    <td>{{ $admin->username}}</td>
                                    <td>{{ $admin->type}}</td>
                                    <td>{{ $roles}}</td>
                                    <td>{{ ucfirst($admin->created_at)}}</td>
                                    <td>{{ ucfirst($admin->updated_at)}}</td>
                                    <td>
                                        @if($admin->status==1)
                                        <span style="color:green"><strong>Active</strong> </span>
                                        @else
                                        <span style="color: red"><strong>Inactive</strong> </span>
                                        @endif</td>

                                    <td>
                                        <a title="Edit Admin / Sub-Admin"  href="{{url('/admin/edit-admin/'.$admin->id)}}" class="btn btn-primary ]" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-edit"></i></a>
                                        <a title="Delete Admin / Sub-Admin" rel="{{$admin->id}}" rel1="delete-admin" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection