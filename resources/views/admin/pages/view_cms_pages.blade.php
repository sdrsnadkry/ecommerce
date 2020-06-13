@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View CMS Pages</a> </div>
        <h1>CMS Pages</h1>
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
                        <h5>All CMS Pages</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Page Title</th>
                                    <th>Page URL</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($cmsPages as $key=>$page)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucfirst($page->title)}}</td>
                                    <td><a target="new" href="{{url('/page/'.$page->url)}}">{{url('/page/'.$page->url)}}</a></td>
                                    <td>{{ ucfirst($page->created_at)}}</td>

                                   
                                    <td> @if($page->status==1) Active @else <span style="color:red">Inactive</span>  @endif</td>
                                  
                                    <td>
                                        <a title="View Product Details" href="#myModal{{ $page->id }}" data-toggle="modal" class="btn btn-success" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-eye-open"></i></a>
                                        <a title="Edit Page" href="{{ url('/admin/edit-cms-page/'.$page->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-pencil"></i></a>
                                        <a title="Delete Page" rel="{{$page->id}}" rel1="delete-page" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <div id="myModal{{ $page->id }}" class="modal hide">
                                    <div class="modal-header">
                                        <div class="widget-box">
                                            <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
                                                <h5 style="font-weight:bold">{{ ucfirst($page->title)}} Page Details</h5>
                                                <button data-dismiss="modal" class="close " type="button">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body" style="padding:0px">
                                        <div class="widget-box">
                                            <div class="widget-content padding">
                                                <div style="margin-left:80px"><img src="{{ asset('/images/backend_images/pages/small/'.$page->image) }}" alt=""></div> 
                                                <p><strong>Page ID:</strong>  {{ $page->id }}</p>
                                                <p><strong>URL:</strong>  {{ $page->url }}</p>
                                                <p><strong>Created At:</strong>  {{ $page->created_at }}</p>
                                                <p><strong>Updated At:</strong>  {{ $page->updated_at }}</p>
                                                <p><strong>Status:</strong>  @if($page->status==1) Active @else Not Active @endif </p>
                                                <p><strong>Description:</strong>  {{$page->description}}</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
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