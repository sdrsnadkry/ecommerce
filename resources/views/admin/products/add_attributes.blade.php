@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Add Products Attributes</a> </div>
        <h1>Product Attributes</h1>
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
                        <h5>Add Product Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/add-attributes/'.$productDetails->id) }}" name="add_attributes" id="add_attributes" enctype="multipart/form-data">
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
                                <label class="control-label">Product Color</label>
                                <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>

                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Color</label>
                                <div class="controls field_wrapper">
                                    <div>
                                        <input type="text" name="sku[]" id="sku"  placeholder="SKU" required/>
                                        <input type="text" name="size[]" id="size"  placeholder="Size" required/>
                                        <input type="number" name="price[]" id="price"  placeholder="Price" required/>
                                        <input type="number" name="stock[]" id="stock"  placeholder="Stock" required/>
                                        <a href="javascript:void(0);" class="add_button btn btn-inverse" title="Add Attributes"><i class="icon-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <input type="submit" value="Add Attributes" class="btn btn-success">
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
                        <h5>All Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" method="post" action="{{ url('/admin/edit-attributes/'.$productDetails->id) }}" name="edit_attributes" id="edit_attributes" method="POST">
                            {{csrf_field()}}
                            <table class="table table-bordered data-table ">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Actions</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productDetails['attributes'] as $key=> $attribute)
                                    <tr class="gradeX">
                                        <td><input type="hidden" name="idAttr[]" value="{{$attribute->id}}" >
                                            {{ $key+1 }}
                                        </td>
                                        <td>{{ ucfirst($attribute->sku)}}</td>
                                        <td><input type="text" name="size[]" value="{{ ucfirst($attribute->size)}}"></td>
                                        <td><input type="text" name="price[]" value="{{ ucfirst($attribute->price)}}"></td>
                                        <td><input type="text" name="stock[]" value="{{ ucfirst($attribute->stock)}}"></td>
                                        <td>
                                            <button  class=" btn-primary " style="border-radius:50%; font-size:20px; padding:10px;" ><i class="icon-pencil"></i></button>
                                            <a rel="{{$attribute->id}}" rel1="delete-attribute" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;" ><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
