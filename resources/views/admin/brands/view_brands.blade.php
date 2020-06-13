@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Brands</a> </div>
        <h1>Brands</h1>
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
                        <h5>All Brands</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Brand Name</th>
                                    <th>Brand Link</th>
                                    <th>Brand Image</th>
                                    <th>Brand Status</th>
                                  
                                    <th>Actions</th>
                                </tr>
                            </thead>
                             <tbody>
                                @foreach ($brands as $key=>$brand)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucfirst($brand->name)}}</td>
                                    <td>{{ucfirst($brand->url)}}</td>
                                    <td>
                                        <img src="{{ asset('/images/frontend_images/brands/'.$brand->image) }}" alt="" width="200">
                                    </td>
                                    
                                    <td>@if($brand->status==1) Active @else Inactive @endif</td>
                                    
                                    <td>
                                        <a title="Edit Brand" href="{{ url('/admin/edit-brand/'.$brand->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-pencil"></i></a>
                                        <a title="Delete Brand" rel="{{$brand->id}}" rel1="delete-brand" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
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