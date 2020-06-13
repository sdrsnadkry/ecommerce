@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Checkout</li>
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
        <form action="{{url('/checkout')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input id="billing_name" name="billing_name" class="form-control" type="text" placeholder="Billing Name" @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif />
                        </div>
                        <div class="form-group">
                            <input id="billing_address" name="billing_address" class="form-control" type="text" placeholder="Billing Address" @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif />
                        </div>
                        <div class="form-group">
                            <input id="billing_city" name="billing_city" class="form-control" type="text" placeholder="Billing City" @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input id="billing_state" name="billing_state" class="form-control" type="text" placeholder="Billing State" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif/>
                        </div>
                        <div class="form-group">
                            <select name="billing_country" id="billing_country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option  value="{{$country->country_name}}" @if ($country->country_name == $userDetails->country) selected @endif>
                                    {{$country->country_name}}
                                </option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="billing_pincode" name="billing_pincode" class="form-control" type="text" placeholder="Billing Pincode" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input id="billing_mobile" name="billing_mobile" class="form-control" type="text" placeholder="Billing Mobile" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif/>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="copyAddress">
                            <label class="form-check-label" for="materialUnchecked">Is Billing And Shipping Address Same?</label>
                        </div>
                      
                        
                        
                        
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input id="shipping_name" name="shipping_name"  class="form-control" type="text" placeholder="Shipping Name" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif/>
                        </div>
                        <div class="form-group">
                            <input id="shipping_address" name="shipping_address" class="form-control" type="text" placeholder="Shipping Address"  @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif />
                        </div>
                        <div class="form-group">
                            <input id="shipping_city" name="shipping_city" class="form-control" type="text" placeholder="Shipping City"  @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif />
                        </div>
                        <div class="form-group">
                            <input id="shipping_state" name="shipping_state" class="form-control" type="text" placeholder="Shipping State"  @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif />
                        </div>
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country">
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                <option  @if(!empty($shippingDetails->country)) value="{{$country->country_name}}" @endif @if ((!empty($shippingDetails->country)) && ($country->country_name == $shippingDetails->country)) selected @endif>
                                    {{$country->country_name}}
                                </option>
                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="shipping_pincode" name="shipping_pincode" class="form-control" type="text" placeholder="Shipping Pincode"  @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif />
                        </div>
                        <div class="form-group">
                            <input id="shipping_mobile" name="shipping_mobile" class="form-control" type="text" placeholder="Shipping Mobile"  @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif />
                        </div>      
                        <button type="submit" class="btn btn-default btn-lg cart btn-rounded pull-right"> Proceed </button>
                        
                    </div><!--/sign up form-->
                </div>
            </div>
        </form>
    </div>
</section><!--/formss-->

@endsection