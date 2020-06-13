@extends('layouts.frontLayout.front_design')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Your Orders</li>
            </ol>
        </div>
       
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading text-center">
            <div class="table-responsive">
                <table id="orderTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            
                            <th>S.N</th>
                            <th>Order ID</th>
                            <th>Ordered Product</th>
                            <th>Payment Method</th>
                            <th>Grand Total</th>
                            <th>Created On</th>
                            <th>Order Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     
                        @foreach ($orders as $key=>$order)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$order->id}}</td>
                                <td>
                                    @foreach ($order->orders as $item)
                                    <a href="{{url('/orders/'.$order->id)}}">{{$item->product_name}}</a>
                                      
                                      <br>
                                    @endforeach
                                </td>
                                <td>{{$order->payment_method}}</td>
                                <td>${{$order->grand_total}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->order_status}}</td>
                               
                            </tr>
                            
                        @endforeach                   
                </table>
              </div>
           
            
        </div>
    </div>
</section>
<!--/#do_action-->

    
@endsection