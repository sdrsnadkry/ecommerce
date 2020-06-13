@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/admin/dashboard')}}" title="Go to Dashboard" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Orders</a> </div>
        <h1>Orders</h1>
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
              <h5>All Orders</h5>
            </div>
            <div class="widget-content nopadding">
              {{-- <pre>
                @php
                    
                    print_r($categories);
                @endphp
              </pre> --}}
              <table class="table table-bordered data-table">
                <thead>
                  <tr>
                    <th>S.N</th>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Ordered Products</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Order Status</th>
                    <th>Action</th>
                    
                  </tr>
                </thead>
                <tbody>
                 @foreach ($orders as $key=>$order)
                  <tr class="gradeX">
                      <td>{{$key+1}}</td>
                      <td>{{$order->id}}</td>
                      <td>{{$order->created_at}}</td>
                      <td>{{$order->name}}</td>
                      <td>{{$order->user_email}}</td>
                      <td>
                          @foreach ($order->orders as $item)
                          {{$item->product_name}} :: {{$item->product_qty}}pcs
                          <br>
                              
                          @endforeach
                      </td>
                      
                      <td>{{$order->grand_total}}</td>
                      <td>{{$order->payment_method}}</td>
                      <td>{{$order->order_status}}</td>
                      <td>
                          <a title="View Order" target="new" href="{{ url('/admin/view-order/'.$order->id)}}" class="btn btn-success" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-eye-open"></i></a>
                          <a title="View Order Invoice" target="new" href="{{ url('/admin/view-order-invoice/'.$order->id)}}" class="btn btn-primary" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-file"></i></a>
                          <a title="View Order PDF" target="new" href="{{ url('/admin/view-pdf-invoice/'.$order->id)}}" class="btn btn-inverse" style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-file"></i></a>
                          <a title="Delete Order" rel="{{$order->id}}" rel1="delete-order"  href="javascript:" class="btn btn-danger deleteRecord"  style="border-radius:50%; font-size:20px; padding:10px;"><i class="icon-trash"></i></a>
                          
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