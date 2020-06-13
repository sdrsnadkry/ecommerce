@php
use App\user;
@endphp
@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Users</a> </div>
        <h1>Users</h1>
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
                        <h5>All Users</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Online</th>
                                    <th>Online</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Registered On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key=> $user)
                                <tr class="gradeX">

                                    <td>
                                        <a class="getStatus" type="text">{{$user->id}} </a>                                      
                                   </td>
                                    <td>{{ ucfirst($user->name)}}</td>
                                    <td id="liveStatus">
                                        @php
                                        $isOnline = User::isOnline($user->id);
                                        if ($isOnline) {
                                        echo "<font color='green'> <strong>Online</strong> </font>";
                                        }else{
                                        echo "<font color='red'> <strong>Offline</strong> </font>";
                                        }
                                        @endphp
                                    </td>
                                    <td>
                                        <a class="showStatus" id="showStatus{{$user->id}}" type="text"></a>                                       
                                    </td> 
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->mobile}}</td>
                                    <td>{{ ucfirst($user->address)}}</td>
                                    <td>{{ ucfirst($user->city)}}</td>
                                    <td>{{ ucfirst($user->state)}}</td>
                                    <td>{{ ucfirst($user->pincode)}}</td>
                                    <td>{{ ucfirst($user->country)}}</td>
                                    <td>{{ ucfirst($user->created_at)}}</td>
                                    <td>
                                        @if($user->status==1)
                                        <span style="color:green"><strong>Active</strong> </span>
                                        @else
                                        <span style="color: red"><strong>Inactive</strong> </span>
                                        @endif</td>

                                    <td>
                                        <a title="Delete User" rel="{{$user->id}}" rel1="delete-user" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
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