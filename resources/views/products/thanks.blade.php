@extends('layouts.frontLayout.front_design')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Confirmation</li>
            </ol>
        </div>
       
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading text-center">
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
            <div class="text-center" >
                <img src="{{asset('images/frontend_images/home/logo.png')}}" alt="">
                <h1 style="font-weight: 700" >THANK YOU!!</h1>
                <h3>Your Order Has Been Placed Successfully!</h3>
                <p>
                    Your Order Number is: <strong>{{Session::get('order_id')}}</strong>  && Total Amount is: <strong>${{Session::get('grand_total')}}</strong> 
                </p>
                <h1><i class="fa fa-envelope"></i></h1>
                <h2> Please Check Your Email For Further Details.</h2>
            </div>
            
        </div>
    </div>
</section>
<!--/#do_action-->

    
@endsection

@php
    Session::forget('grand_total');
    Session::forget('order_id');
@endphp