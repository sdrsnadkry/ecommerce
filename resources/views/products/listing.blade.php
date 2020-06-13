@extends('layouts.frontLayout.front_design')
@section('content')

<section>
    <div class="container">
        
        <div class="row">
            
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <strong ><h1 style="margin-bottom:25px" class="title text-center">
                        @if(!empty($search_product))
                        {{ucfirst($search_product)}}
                        @else
                        {{strtoupper($categoryDetails->name)}}
                        @endif
                    </h1>
                    </strong>
                    <div class="">
                        <ol class="breadcrumb">
                            <li>
                                @php
                              echo $breadcrumb;
                          @endphp
                            </li>
            
                        </ol>
                    </div>
                    
                    @foreach ($productsAll as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" />
                                        <h2>${{$product->price}}</h2>
                                        <p>{{$product->product_name}}</p>
                                       
                                        <a href="{{url('product/'.$product->id)}}" class="btn btn-default cart "><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    {{-- <div class="product-overlay">
                                        <div class="overlay-content text-center">
                                            <h2>${{$product->price}}</h2>
                                            <p>{{$product->product_name}}</p>
                                            <a href="#" class="btn btn-default btn add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div> --}}
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                    <div class="text-center">

                        {{-- {{$productsAll->links()}} --}}
                    </div>
                    
                </div><!--features_items-->
             
                
            </div>
        </div>
    </div>
</section>
    
@endsection

