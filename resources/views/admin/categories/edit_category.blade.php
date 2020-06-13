@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Catagories</a> </div>
      <h1>Categories</h1>
    </div>
    <div class="container-fluid"><hr>
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Edit Category</h5>
            </div>
            <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ url('/admin/edit-category/'.$categoryDetails->id) }}" name="add_category" id="add_category" novalidate="novalidate">
              {{  csrf_field() }}
             

                <div class="control-group">
                  <label class="control-label">Category Name</label>
                  <div class="controls">
                  <input type="text" name="category_name" id="category_name" value="{{$categoryDetails->name}}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">If Sub Category</label>
                  <div class="controls">
                    <select name="parent_id" id="parent_id" style="width:220px;">
                      <option value="0">Main Category</option>
                      @foreach ($levelss as $value)
                        <option value="{{$value->id}}" @if($value->id == $categoryDetails->parent_id) selected @endif >
                          
                          {{$value->name}}
                        </option>    
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Description</label>
                  <div class="controls">
                    <textarea type="text" name="description" id="description" rows="4">{{$categoryDetails->description}}</textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">URL</label>
                  <div class="controls">
                    <input type="text" name="url" id="url"  value="{{$categoryDetails->url}}">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Active/Inactive</label>
                  <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($categoryDetails->status=='1') checked @endif value="1">
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Category" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
   
    </div>
  </div>
    
@endsection