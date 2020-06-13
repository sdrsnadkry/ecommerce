@extends('layouts.frontLayout.front_design')
@section('content')
<section style="margin-top:30px">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.frontLayout.front_sidebar')
            </div>
            <div class="col-sm-9 padding-right">
                <div id="contact-page" class="container">
                    <div class="row">
                        <div class="col-sm-8">
{{--                             
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">X</button>
                                <strong>
                                    @{{responsemsg}}
                                </strong>
                            </div> --}}

                            @if(Session::has('flash_message_success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    <strong>
                                        {!! session('flash_message_success') !!}
                                    </strong>
                                </div>
                                @endif
                                @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">X</button>
                                    {{$error}}
                                </div>
                                @endforeach
                            @endif
                            <div class="contact-form" id="app">
                                <h2 class="title text-center">@{{ testmsg}}</h2>
                                <div class="status alert alert-success" style="display: none"></div>
                                <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" v-on:submit.prevent="addPost">
                                    {{csrf_field()}}
                                    <div class="form-group col-md-6">
                                        <input type="text" v-model="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" v-model="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="text" v-model="subject" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <textarea v-model="message" id="message" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                                    </div>
                                    <div class="form-group col-md-12 text-center">
                                        <button type="submit" click="resetFilters" class="btn btn-success gets " >Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="margin-top: 50px;">
                        <div class="row text-center">
                            <div class="col-sm-8">
                                <div class="contact-info">
                                    <h2 class="title text-center">Contact Info</h2>
                                    <address>
                                        <p>E-Shopper Inc.</p>
                                        <p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
                                        <p>Newyork USA</p>
                                        <p>Mobile: +2346 17 38 93</p>
                                        <p>Fax: 1-714-252-0026</p>
                                        <p>Email: info@e-shopper.com</p>
                                    </address>
                                    <div class="social-networks">
                                        <h2 class="title text-center">Social Networking</h2>
                                        <ul>
                                            <li>
                                                <a href="#"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-youtube"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/#contact-page-->
            </div>
        </div>
    </div>
</section>
@endsection