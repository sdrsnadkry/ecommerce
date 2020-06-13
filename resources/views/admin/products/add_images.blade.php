@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Products Attributes</a> </div>
        <h1>Product Images</h1>
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
                        <h5>Add Product Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-images/'.$productDetails->id) }}" name="add_images" id="add_images" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                          
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>

                            </div>
                            <div class="control-group">
                                <label class="control-label">Add Images</label>
                              <div class="controls">
                                  <input type="file" name="image[]" id="image" multiple="multiple">
                              </div>

                            </div>
                          
                            <div class="form-actions">
                                <input type="submit" value="Add Images" class="btn btn-info">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>All Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table ">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Images</th>
                                    <th>Actions</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productImages as $key=> $images)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ asset('images/backend_images/products/small/'.$images->image)}}" alt="" width="50 "></td>
                                    
                                    <td>
                                        <a rel="{{$images->id}}" rel1="delete-alt-image" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;" ><i class="icon-trash"></i></a>
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
