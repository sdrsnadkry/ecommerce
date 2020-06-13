@extends('layouts.frontLayout.front_design')
@section('content')

<section style="margin-top:30px">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <!--features_items-->
                    <h2 class="title text-center">{{$cmsPageDetails->title}}</h2>
                    <div class="container-fluid">
                        <p>{{$cmsPageDetails->description}}</p>

                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection