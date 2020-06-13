@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Banners</a> </div>
        <h1>Banners</h1>
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
                        <h5>All Banners</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Banner Title</th>
                                    <th>Banner Link</th>
                                    <th>Banner Image</th>
                                    <th>Banner Status</th>
                                  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach ($banners as $key=>$banner)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucfirst($banner->title)}}</td>
                                    <td>{{ucfirst($banner->link)}}</td>
                                    <td>
                                        <img src="{{ asset('/images/frontend_images/banners/'.$banner->image) }}" alt="" width="200">
                                    </td>
                                    
                                    <td>@if($banner->status==1) Active @else Inactive @endif</td>
                                    
                                    <td>
                                        <a title="Edit Banner" href="{{ url('/admin/edit-banner/'.$banner->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-pencil"></i></a>
                                        <a title="Delete Banner" rel="{{$banner->id}}" rel1="delete-banner" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
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