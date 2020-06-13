@extends('layouts.frontLayout.front_design')
@section('content')
<section id="form">
    <!--form-->
    <div class="container" id="loginform">
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
                    <h2>User Login </h2>
                    <form action="{{url('/user-login')}}" method="POST" id="loginForm" name="loginForm">
                        {{csrf_field()}}
                        <input name="email" type="email" placeholder="Email Address" />
                        <input name="password" type="password" placeholder="Password" />
                        {{-- <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span> --}}
                       
                        <button type="submit" class="btn btn-default cart"> <i class="fa fa-lock"></i> Login</button><br>
                        <a class="btn" href="{{url('/forgot-password')}}">Forgot Password</a>
                        <div style="margin-top: 10px">
                            <div class="google-btn">
                                <a href="{{ url('/redirect') }}">
                                    <div class="google-icon-wrapper">
                                        <img class="google-icon " src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" />
                                    </div>
                                    <p class="btn-text"><b>Sign in with google</b></p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Register Now!</h2>
                    <form action="{{url('/user-register')}}" method="POST" id="registerForm">
                        {{csrf_field()}}
                        <input name="name" id="name" type="text" placeholder="Name" />
                        <input name="email" id="email" type="email" placeholder="Email Address" />
                        <input name="password" id="myPassword" type="password" placeholder="Password" />
                        <input name="conpassword" id="conpassword" type="password" placeholder="Confirm Password" />
                        <button type="submit" class="btn btn-default cart ">Signup</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
@endsection