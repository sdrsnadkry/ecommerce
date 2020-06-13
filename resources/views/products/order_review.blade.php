@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Order Review</li>
            </ol>
        </div>
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
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Billing Address</h2>
                    <div class="form-group">
                        <input id="billing_name" name="billing_name" class="form-control" type="text" placeholder="Billing Name" value="{{$userDetails->name}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_address" name="billing_address" class="form-control" type="text" placeholder="Billing Address" value="{{$userDetails->address}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_city" name="billing_city" class="form-control" type="text" placeholder="Billing City" value="{{$userDetails->city}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_state" name="billing_state" class="form-control" type="text" placeholder="Billing State" value="{{$userDetails->state}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_country" name="billing_country" class="form-control" type="text" placeholder="Billing State" value="{{$userDetails->country}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_pincode" name="billing_pincode" class="form-control" type="text" placeholder="Billing Pincode" value="{{$userDetails->pincode}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_mobile" name="billing_mobile" class="form-control" type="text" placeholder="Billing Mobile" value="{{$userDetails->mobile}}" disabled />
                    </div>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2></h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Shipping Address</h2>
                    <div class="form-group">
                        <input id="shipping_name" name="shipping_name" class="form-control" type="text" placeholder="Shipping Name" value="{{$shippingDetails->name}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="shipping_address" name="shipping_address" class="form-control" type="text" placeholder="Shipping Address" value="{{$shippingDetails->address}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="shipping_city" name="shipping_city" class="form-control" type="text" placeholder="Shipping City" value="{{$shippingDetails->city}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="shipping_state" name="shipping_state" class="form-control" type="text" placeholder="Shipping State" value="{{$shippingDetails->state}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="billing_country" name="billing_country" class="form-control" type="text" placeholder="Billing State" value="{{$shippingDetails->country}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="shipping_pincode" name="shipping_pincode" class="form-control" type="text" placeholder="Shipping Pincode" value="{{$shippingDetails->pincode}}" disabled />
                    </div>
                    <div class="form-group">
                        <input id="shipping_mobile" name="shipping_mobile" class="form-control" type="text" placeholder="Shipping Mobile" value="{{$shippingDetails->mobile}}" disabled />
                    </div>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<section id="cart_items">
    <div class="container">
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed table-responsive">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_amount = 0;
                    @endphp
                    {{-- {{$productDetails}} --}}
                    @foreach ($userCart as $cart)
                    <tr>
                        <td >
                            <a><img width="80" src="{{asset('images/backend_images/products/small/'.$cart->image)}}" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a>{{$cart->product_name}}</a></h4>
                            <p>Product Code: {{$cart->product_code}}</p>
                            <p>Size: {{$cart->size}}</p>
                        </td>
                        <td class="cart_price">
                            <p>${{$cart->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$cart->quantity}}" autocomplete="off" size="2" disabled />
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$cart->price*$cart->quantity}}</p>
                        </td>
                    </tr>
                    @php
                    $total_amount = $total_amount+($cart->price*$cart->quantity);
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>${{$total_amount}}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    @php
                                    $grand_total = $total_amount
                                        
                                    @endphp
                                    <td><span> ${{$grand_total}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
            <form action="{{url('/place-order')}}" name="paymentForm" id="paymentForm" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-sm-9">
                        <span><strong>Select Payment Method:</strong></span>
                        
                        <input type="hidden" name="grand_total" value="{{$grand_total}}">
                        <div class="for-check" style="margin-top:15px">
                            <label class="radio-inline"><input type="radio" name="payment_method" id="COD" value="COD" ><strong>COD[Cash On Delivery]</strong> </label>
                            <label class="radio-inline"><input type="radio" name="payment_method" id="Paypal" value="Paypal"  title="Not Available Right Now" disabled>Paypal</label>
                            <span id="chkPayment"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button style="margin-top:15px" type="submit" class="btn btn-default cart" onclick="return selectPaymentMethod();">Confirm Order</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>
<!--/#cart_items-->
<!--/form-->
@endsection