@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Products</a> </div>
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
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>All Products</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Product Code</th>
                                    <th>Product Color</th>
                                    <th>Price($)</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Product Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key=>$product)
                                <tr class="gradeX">
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucfirst($product->product_name)}}</td>
                                    <td>{{ucfirst($product->category_name)}}</td>
                                    <td>{{ ucfirst($product->product_code)}}</td>
                                    <td>{{ ucfirst($product->product_color)}}</td>
                                    <td>{{ ucfirst($product->price)}}</td>
                                    <td>@if($product->status==1) Active @else <span style="color:red">Inactive</span>  @endif</td>
                                    <td>@if($product->feature_item==1) Featured @else <span style="color:red">Not Featured</span>  @endif</td>
                                    <td>
                                        <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" alt="" width="50">
                                    </td>
                                    <td>
                                        <a title="View Product Details" href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-eye-open"></i></a>
                                        <a title="Edit Product" href="{{ url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-pencil"></i></a>
                                        <a title="Add/Delete Attributes" href="{{ url('/admin/add-attributes/'.$product->id)}}" class="btn btn-inverse" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-edit"></i></a>
                                        <a title="Add/Delete Images" href="{{ url('/admin/add-images/'.$product->id)}}" class="btn btn-info" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-film"></i></a>
                                        <a title="Delete Product" rel="{{$product->id}}" rel1="delete-product" href="javascript:" class="btn btn-danger deleteRecord" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <div id="myModal{{ $product->id }}" class="modal hide">
                                    <div class="modal-header">
                                        <div class="widget-box">
                                            <div class="widget-title"> <span class="icon"> <i class="icon-eye-open"></i> </span>
                                                <h5 style="font-weight:bold">{{ ucfirst($product->product_name)}} Details</h5>
                                                <button data-dismiss="modal" class="close " type="button">×</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body" style="padding:0px">
                                        <div class="widget-box">
                                            <div class="widget-content padding">
                                                <div style="margin-left:80px"><img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" alt=""></div>
                                                <p>ID: {{ $product->id }}</p>
                                                <p>Name: {{ $product->product_name }}</p>
                                                <p>Category: {{ $product->category_name }}</p>
                                                <p>Code: {{ $product->product_code }}</p>
                                                <p>Color: {{ $product->product_color }}</p>
                                                <p>Price: {{ $product->price}}</p>
                                                <p>Description: {{ $product->description}}</p>
                                                <p>Material & Care: {{ $product->care}}</p>
                                                <p>Status: @if($product->status==1) Active @else Inactive @endif </p>
                                                <p>Featured: @if($product->feature_item==1) Featured @else Not Featured @endif </p>
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