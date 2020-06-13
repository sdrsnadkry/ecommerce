@extends('layouts.frontLayout.front_design')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="product-details">
                    <!--product-details-->
                    <div class="col-sm-7">
                        <div class="view-product">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                <a href="{{asset('images/backend_images/products/large/'.$productDetails->image)}}">
                                    <img width="350" src="{{asset('images/backend_images/products/medium/'.$productDetails->image)}}" alt="" class="mainImage" />
                                </a>
                            </div>
                        </div>
                        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <div class="thumbnails">
                                <a href="{{asset('images/backend_images/products/large/'.$productDetails->image)}}" data-standard="{{asset('images/backend_images/products/small/'.$productDetails->image)}}">
                                    <img class="changeImage" id="changeImage" src="{{asset('images/backend_images/products/small/'.$productDetails->image)}}" alt="" width="100">
                                </a>
                                @foreach ($productAltImages as $altImage)
                                <a href="{{asset('images/backend_images/products/large/'.$altImage->image)}}" data-standard="{{asset('images/backend_images/products/small/'.$altImage->image)}}">
                                    <img class="changeImage" id="changeImage" src="{{asset('images/backend_images/products/small/'.$altImage->image)}}" alt="" width="100">
                                </a>
                                @endforeach
                            </div>
                        </div> --}}
                        <div id="similar-product" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner thumbnails">
                                @php
                                $count = 1;
                                @endphp
                                @foreach ($productAltImages->chunk(3) as $chunk)
                                <div class="item @if($count==1) active @endif">
                                    @foreach ($chunk as $altImage)
                                    <a href="{{asset('images/backend_images/products/large/'.$altImage->image)}}" data-standard="{{asset('images/backend_images/products/small/'.$altImage->image)}}">
                                        <img class="changeImage" width="85" src="{{asset('images/backend_images/products/small/'.$altImage->image)}}" alt="">
                                    </a>
                                    @endforeach
                                </div>
                                @php
                                $count++
                                @endphp
                                @endforeach
                            </div>
                            <!-- Controls -->
                            <a class="left item-control" href="#similar-product" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right item-control" href="#similar-product" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form class="addtocartForm" method="post" action="{{ url('/add-cart') }}" name="addtocartForm" id="addtocartForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                            <input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
                            <input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
                            <input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
                            <input type="hidden" name="price" id="price">
                            <div class="product-information">
                                <!--/product-information-->
                                <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                                @if(Session::has('flash_message_error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <strong>
                                        {!! session('flash_message_error') !!}
                                    </strong>
                                </div>
                                @endif
                                <ol class="breadcrumb">
                                    <li>
                                        @php
                                        echo $breadcrumb;
                                        @endphp
                                    </li>
                                </ol>
                                <h1><strong>{{$productDetails->product_name}}</strong></h1>
                                <p>Product Code: {{$productDetails->product_code}}</p>
                                <p>Color: {{$productDetails->product_color}}</p>
                                <p class="justify-content-center">
                                    <select name="size" id="selSize" class="form-control" required>
                                        <option value="">Select Sizes</option>
                                        @foreach ($productDetails->attributes as $sizes)
                                        <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
                                    <span id="getPrice">US ${{$productDetails->price}}</span>
                                    <label>Quantity:</label>
                                    <input type="text" name="quantity" value="1" />
                                    @if($total_stock>0)
                                    <button type="submit" class="btn btn-default cart" id="cartButton">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </button>
                                    @endif
                                </span>
                                <p><b>Availability:</b> <span id="Availability">@if($total_stock>0) In Stock @else Out Of Stock @endif</span> </p>
                                <p><b>Condition:</b> New</p>
                                {{-- <p><b>Brand:</b> E-SHOPPER</p> --}}
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
                            </div>
                            <!--/product-information-->
                        </form>
                    </div>
                </div>
                <!--/product-details-->
                <div class="category-tab shop-details-tab">
                    <!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#care" data-toggle="tab">Material & Crae</a></li>
                            <li><a href="#delivery" data-toggle="tab">Delivery Options</a></li>
                            @if(!empty($productDetails->video))
                            <li><a href="#videos" data-toggle="tab">Product Video</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="description">
                            <div class="col-md-12">
                                <p>
                                    {{$productDetails->description}}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="care">
                            <div class="col-md-12">
                                <p>
                                    {{$productDetails->care}}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="delivery">
                            <div class="col-md-12">
                                <p>Add Options Or details about delivery(static right now)
                                </p>
                            </div>
                        </div>
                        @if(!empty($productDetails->video))
                    <div class="tab-pane fade" id="videos">
                            <div class="col-md-12">
                                <video width="300" height="200" controls>
                                    <source src="{{url('videos/'.$productDetails->video)}}" type="video/mp4">
                                </video>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!--/category-tab-->
                <div class="recommended_items">
                    <!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php
                            $count = 1;
                            @endphp
                            @foreach ($relatedProducts->chunk(3) as $chunk)
                            <div class="item @if($count==1) active @endif ">
                                @foreach ($chunk as $item)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img style="width:200px" src="{{asset('images/backend_images/products/small/'.$item->image)}}" alt="" />
                                                <h2>${{$item->price}}</h2>
                                                <p>{{$item->product_name}}</p>
                                                <a type="button" href="{{url('/product/'.$item->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @php
                            $count++
                            @endphp
                            @endforeach
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                <!--/recommended_items-->
            </div>
        </div>
    </div>
</section>
<script>
</script>
@endsection