@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Edit Products</a> </div>
        <h1>Products</h1>
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
                        <form class="form-horizontal" method="post" action="{{ url('/admin/edit-product/'.$productDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="control-group">
                                <label class="control-label">Under Category</label>
                                <div class="controls">
                                    <select name="category_id" id="category_id" style="width:220px;">
                                       @php 
                                           echo $categories_dropdown
                                       @endphp 
                                                                               
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Name</label>
                                <div class="controls">
                                    <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Code</label>
                                <div class="controls">
                                    <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Color</label>
                                <div class="controls">
                                    <input type="text" name="product_color" id="product_color" value="{{ $productDetails->product_color }}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Description</label>
                                <div class="controls">
                                    
                                    <textarea type="text" name="description" id="description" rows="4" >{{ $productDetails->description}}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Material & Care</label>
                                <div class="controls">
                                    
                                    <textarea type="text" name="care" id="care" rows="4" >{{ $productDetails->care}}</textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Price</label>
                                <div class="controls">
                                    <input type="text" name="price" id="price" value="{{ $productDetails->price }}">
                                </div>
                            </div>
                            {{-- <div class="control-group">
                                <label class="control-label">Image upload </label>
                                <div class="image">
                                    <input type="hidden" name = "current_image" value={{$productDetails->image}}> 
                                    @if(!empty($productDetails->image)) 
                                        <img src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}" alt="">
                                        ||  <a class="btn btn-danger" href="{{url('/admin/delete-product-image/'.$productDetails->id)}}}}"><i class="icon-trash"></i></a>
                                    @endif
                                    </div>
                                <div class="controls">
                                    <input type="file" name="image" id="image">
                                </div>
                              </div> --}}
                              <div class="control-group">
                                <label class="control-label">Active/Inactive</label>
                                <div class="controls">
                                <input type="checkbox" name="status" id="status" @if($productDetails->status=='1') checked @endif value="1">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Featured Item</label>
                                <div class="controls">
                                <input type="checkbox" name="feature_item" id="feature_item" @if($productDetails->feature_item=='1') checked @endif value="1">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Show In Small Banner</label>
                                <div class="controls">
                                <input type="checkbox" name="show_banner" id="show_banner" @if($productDetails->show_banner=='1') checked @endif value="1">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Image upload </label>
                                <div class="controls">
                                    <input type="hidden" name = "current_image" value={{$productDetails->image}}> 
                                    <img src="{{ asset('/images/backend_images/products/small/'.$productDetails->image) }}" alt="" class="" id="thumb" width="100">
                                </div>
                                <div class="controls">
                                    <input type="file" name="image" id="image" onchange="readUrl(this,'thumb')">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label">Video upload </label>
                                <div class="controls">
                                    @if (!empty($productDetails->video))
                                    <input type="hidden" name = "current_video" value={{$productDetails->video}}> 
                                    <a target="new" href="{{url('videos/'.$productDetails->video)}}">|| <i class="icon-play" ></i>|| </a>                                        
                                    @endif
                                    <input type="file" name="video" id="video">

                                   
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
