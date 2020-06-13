@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit CMS Page</a> </div>
        <h1>CMS Page</h1>
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
                        <h5>Edit Product</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/edit-cms-page/'.$pageDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            
                            <div class="control-group">
                                <label class="control-label">Title</label>
                                <div class="controls">
                                    <input type="text" name="title" id="title" value="{{ $pageDetails->title }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Page URL</label>
                                <div class="controls">
                                    <input type="text" name="url" id="url" value="{{ $pageDetails->url }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    
                                    <textarea type="text" name="description" id="description" rows="4" >{{ $pageDetails->description}}</textarea>
                                </div>
                            </div>
                           
                              <div class="control-group">
                                <label class="control-label">Active/Inactive</label>
                                <div class="controls">
                                <input type="checkbox" name="status" id="status" @if($pageDetails->status=='1') checked @endif value="1">
                                </div>
                              </div>
                            <div class="form-actions">
                                <input type="submit" value="Update Product" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
