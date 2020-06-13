@extends('layouts.frontLayout.front_design')
@section('content')
<!--/header-->
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
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
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>

                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_amount = 0;
                    @endphp
                    @foreach ($userCart as $cart)
                        <tr>
                            <td >
                                <a href="{{url('/product/'.$cart->product_id)}}"><img width="80" src="{{asset('images/backend_images/products/small/'.$cart->image)}}" alt="" /></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="{{url('/product/'.$cart->product_id)}}">{{$cart->product_name}}</a></h4>
                                <p>Product Code: {{$cart->product_code}}</p>
                                <p>Size: {{$cart->size}}</p>
                            </td>
                            
                            <td class="cart_price">
                                <p>${{$cart->price}}</p>
                            </td>

                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    
                                    <a class="cart_quantity_up" href="{{url('/cart/update-quantity/'.$cart->id.'/1')}}"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}"
                                        autocomplete="off" size="2" />
                                        @if($cart->quantity>1)
                                            <a class="cart_quantity_down" href="{{url('/cart/update-quantity/'.$cart->id.'/-1')}}"> - </a>
                                        @endif
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">${{$cart->price*$cart->quantity}}</p>
                            </td>
                            <td class="">
                            <a class="btn " style="color:red" href="{{url('/cart/delete-product/'.$cart->product_id)}}"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        @php
                            $total_amount = $total_amount+($cart->price*$cart->quantity);
                        @endphp
                    @endforeach
                   
                   
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Got a coupon?</h3>
            <p>
                Enter code below to get instant discount.
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area ">
                    <input type="text" class="form-control" placeholder="Coupon Code">
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>                       
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total Amount <span> $@php echo $total_amount @endphp </span></li>
                    </ul>
                    <div class="pull-right">
                        @if ($total_amount>0)
                        
                        <a class="btn btn-default cart" href="{{url('/checkout')}}" id="checkout_button" >Check Out</a>
                        @endif

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
    
@endsection