@extends('layouts.frontLayout.front_design')

@section('content')

<section id="slider" style="padding:0px 10px 0px 10px ">

    <!--slider-->

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-7 col-sm-12" id="changePadding1" style="padding:10px 8px 0px 8px ">

                <div class="container-fluid">

                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">

                            @foreach ($banners as $key => $banner)

                            <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="@if($key==0) active @endif"></li>

                            @endforeach

                        </ol>

                        <div class="carousel-inner text-left ">

                            @foreach ($banners as $key => $banner)

                            <div class="item @if($key==0) active @endif" id="main">

                                <img class="" src="{{asset('images/frontend_images/banners/'.$banner->image)}}" alt="">

                                <a href="{{$banner->link}}">

                                    <div class="overlays" id="inside">

                                        <h1><span>E</span>-SHOPPER</h1>

                                        <h2>{{$banner->title}}</h2>

                                    </div>

                                </a>

                            </div>

                            @endforeach

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">

                            <i class="fa fa-angle-left"></i>

                        </a>

                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">

                            <i class="fa fa-angle-right"></i>

                        </a>

                    </div>

                </div>

            </div>

            <div class="col-md-5 col-sm-12" id="changePadding2" style="padding:10px 8px 0px 8px ">

                <div class="">

                    <div class="regular1 ">

                        @foreach ($showBanner as $key => $bannerss)

                        <div id="mains">

                            <img id="changesize" class="img-responsive" src="{{asset('/images/backend_images/products/banner/'.$bannerss->image)}}">

                            <div id="insides">

                                <h1 id="inh2"><span id="insp">E</span>-SHOPPER</h1>

                                <a href="{{url('/product/'.$bannerss->id)}}">

                                    <h2 id="inh1">{{$bannerss->product_name}}</h2>

                                </a>

                            </div>

                        </div>

                        @endforeach

                    </div>



                </div>

            </div>

            {{-- <img width="%" class="img-responsive" src="{{asset('/images/backend_images/products/banner/Image-20200502051027158.jpg')}}" alt=""> --}}

        </div>

    </div>

    </div>

</section>

<!--/slider-->

{{-- added slider --}}

<section>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="regular ">
                @foreach ($brands as $brand)
                <div>
                    <img src="{{asset('/images/frontend_images/brands/'.$brand->image)}}">
                </div>
                @endforeach
            </div>

        </div>

    </div>

</section>

{{-- added slider --}}

<section style="margin-top:30px">

    <div class="container">

        <div class="row">

            <div class="col-sm-3">

                @include('layouts.frontLayout.front_sidebar')

            </div>

            <div class="col-sm-9 padding-right">

                <div class="features_items">

                    <!--features_items-->

                    <h2 class="title text-center">Featured Products</h2>

                    @foreach ($productsAll as $product)

                    <div class="col-sm-4">

                        <div class="product-image-wrapper">

                            <div class="single-products">

                                <div class="productinfo text-center">

                                    <img src="{{asset('images/backend_images/products/small/'.$product->image)}}" alt="" />

                                    <h2>${{$product->price}}</h2>

                                    <p>{{$product->product_name}}</p>

                                    <a href="{{url('product/'.$product->id)}}" class="btn btn-default cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

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

                {{$productsAll->links()}}

            </div>

        </div>

    </div>

    </div>

    </div>

</section>

@endsection