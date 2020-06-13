@extends('layouts.frontLayout.front_design')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('/orders')}}">Orders</a></li>
                <li class="active">Order Details</li>
               
            </ol>
        </div>
       
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading text-center">
            <div class="table-responsive">
                <table id="orderTable" class="table table-striped table-bordered" style="width:100%">
                    <thead >
                        <tr>
                            
                            <th>S.N</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Size</th>
                            <th>Product Color</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                         @foreach ($orderDetails->orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->product_code}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>{{$order->product_size}}</td>
                                <td>{{$order->product_color}}</td>
                                <td>{{$order->product_price}}</td>
                                <td>{{$order->product_qty}}</td>
                               
                               
                            </tr>
                            
                        @endforeach        
                </table>
              </div>
           
            
        </div>
    </div>
</section>
<!--/#do_action-->

    
@endsection