@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
        <h1>Order #{{$orderDetails->id}} Details</h1>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-shopping-cart"></i></span>
                        <h5>Order Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc"> Order Status</td>
                                    <td class="taskStatus"><strong><span class="pending">{{$orderDetails->order_status}}</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"> Order Date</td>
                                    <td class="taskStatus">{{$orderDetails->created_at}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"> Shipping Rate</td>
                                    <td class="taskStatus">{{$orderDetails->shipping_charge}}</td>
                                </tr>                                
                                <tr>
                                    <td class="taskDesc"> Total Amount</td>
                                    <td class="taskStatus">${{$orderDetails->grand_total}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc">Payment Method</td>
                                    <td class="taskStatus">{{$orderDetails->payment_method}}</td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">X</button>
                        <strong>
                            {!! session('flash_message_success') !!}
                        </strong>
                    </div> 
                    @endif 
                    <div class="widget-title"> <span class="icon"><i class="icon-cogs"></i></span>
                        <h5>Update Order Status</h5>
                    </div>
                    <div class="widget-content padding">
                        <form action="{{url('/admin/update-order-status')}}" method="POST">
                            {{csrf_field()}}
                            <div class="row-fluid">
                                <div class="span7">
                                    <select class="control-label" name="order_status" id="order_status" required>
                                        {{-- <option value="{{$orderDetails->order_status}}" selected>{{$orderDetails->order_status}}</option> --}}
                                        <option value="New"@if($orderDetails->order_status == "New") selected @endif >New Order</option>
                                        <option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
                                        <option value="InProcess"@if($orderDetails->order_status == "InProcess") selected @endif >In Process</option>
                                        <option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
                                        <option value="Paid" @if($orderDetails->order_status == "Paid") selected @endif>Paid</option>
                                        <option value="Cancelled"@if($orderDetails->order_status == "Cancelled") selected @endif >Cancelled</option>
                                </select>

                                </div>
                                <div class="span3">
                                    <div class="control">
                                        <input type="hidden" name="order_id" value="{{$orderDetails->id}}">
                                        <input type="submit" class="btn btn-success" value="Update Status">
                                    </div>
                                </div>
                            </div>       
                        </form>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-user"></i></span>
                        <h5>Customer Details</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td class="taskDesc"> Customer Name</td>
                                    <td class="taskStatus">{{$userDetails->name}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"> Customer Email</td>
                                    <td class="taskStatus">{{$userDetails->email}}</td>
                                </tr>
                                <tr>
                                    <td class="taskDesc"> Customer Mobile</td>
                                    <td class="taskStatus">{{$userDetails->mobile}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th-list"></i> </span>
                        <h5>Billing Address</h5>
                    </div>
                    <div class="widget-content nopadding">
                       

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td> Name</td>
                                    <td>{{$userDetails->name}}</td>
                                </tr>
                                <tr>
                                    <td> Address</td>
                                    <td>{{$userDetails->address}}</td>
                                </tr>
                                <tr>
                                    <td> City</td>
                                    <td>{{$userDetails->city}}</td>
                                </tr>
                                <tr>
                                    <td> State</td>
                                    <td>{{$userDetails->state}}</td>
                                </tr>
                                <tr>
                                    <td> pincode</td>
                                    <td>{{$userDetails->pincode}}</td>
                                </tr>
                                <tr>
                                    <td> Mobile</td>
                                    <td>{{$userDetails->mobile}}</td>
                                </tr>
                                <tr>
                                    <td> Country</td>
                                    <td>{{$userDetails->country}}</td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-arrow-right"></i> </span>
                        <h5>Shipping Address</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered">
                           
                            <tbody>
                                <tr>
                                    <td> Name</td>
                                    <td>{{$orderDetails->name}}</td>
                                </tr>
                                {{-- <tr>
                                    <td> Email</td>
                                    <td>{{$orderDetails->user_email}}</td>
                                </tr> --}}
                                <tr>
                                    <td> Address</td>
                                    <td>{{$orderDetails->address}}</td>
                                </tr>
                                <tr>
                                    <td> City</td>
                                    <td>{{$orderDetails->city}}</td>
                                </tr>
                                <tr>
                                    <td> State</td>
                                    <td>{{$orderDetails->state}}</td>
                                </tr>
                                <tr>
                                    <td> pincode</td>
                                    <td>{{$orderDetails->pincode}}</td>
                                </tr>
                                <tr>
                                    <td> Mobile</td>
                                    <td>{{$orderDetails->mobile}}</td>
                                </tr>
                                <tr>
                                    <td> Country</td>
                                    <td>{{$orderDetails->country}}</td>
                                </tr>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
            <hr>
            
        </div>
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-barcode"></i> </span>
                    <h5>Product Details</h5>
                </div>
                <div class="widget-content nopadding">
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
        
       
    </div>
    
</div>
</div>
@endsection