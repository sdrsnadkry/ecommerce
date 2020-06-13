@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Banners</a> </div>
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
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Banner</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/edit-banner/'.$bannerDetails->id) }}" name="edit_banner" id="edit_banner" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           
                            <div class="control-group">
                                <label class="control-label">banner Name</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" value="{{ $bannerDetails->title }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Banner Link</label>
                                <div class="controls">
                                    <input type="text" name="link" id="link" value="{{ $bannerDetails->link }}">
                                </div>
                            </div>
                           
                              <div class="control-group">
                                <label class="control-label">Active/Inactive</label>
                                <div class="controls">
                                <input type="checkbox" name="status" id="status" @if($bannerDetails->status=='1') checked @endif value="1">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Image upload </label>
                                <div class="controls">
                                    <input type="hidden" name = "current_image" value={{$bannerDetails->image}}> 
                                    <img src="{{ asset('/images/frontend_images/banners/'.$bannerDetails->image) }}" alt="" class="" id="thumb" width="500">
                                </div>
                                <div class="controls">
                                    <input type="file" name="image" id="image" onchange="readUrl(this,'thumb')">
                                </div>
                              </div>
                            <div class="form-actions">
                                <input type="submit" value="Update banner" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
