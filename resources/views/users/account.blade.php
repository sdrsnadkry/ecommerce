@extends('layouts.frontLayout.front_design')
@section('content')
	
<section id="form" ><!--form-->
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
                <div class="login-form"><!--login form-->
                    <h2>Update Account</h2>
                    <form action="{{url('/account')}}" method="POST" id="accountForm">
                        {{csrf_field()}}
                        <input name="name" id="name" type="text" placeholder="Name*" value="{{$userDetails->name}}"/>
                        <input name="email" id="email" type="text" placeholder="Email*" value="{{$userDetails->email}} " disabled/>
                        <input name="address" id="address" type="address" placeholder="Address*" value="{{$userDetails->address}}"/>
                        <input name="city" id="city" type="text" placeholder="City*" value="{{$userDetails->city}}"/>
                        <input name="state" id="state" type="text" placeholder="State*" value="{{$userDetails->state}}"/>
                        <select name="country" id="country">
                            <option value="">Select Country</option>
                            {{-- {{$countries}} --}}
                            @foreach ($countries as $country)
                                <option value="{{$country->country_name}}" @if ($country->country_name == $userDetails->country) selected @endif>
                                    {{$country->country_name}}
                                </option>
                                
                            @endforeach
                        </select>
                        <input name="pincode" id="pincode" type="text" placeholder="Pincode(Optional)" style="margin-top:10px" value="{{$userDetails->pincode}}"/>
                        <input name="mobile" id="mobile" type="text" placeholder="mobile" value="{{$userDetails->mobile}}"/>
                        
                        <button type="submit" class="btn btn-default  gets">Update</button>
                    </form>

                    
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">||||</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->   
                    <h2>Update Password</h2>
                    <form action="{{url('/update-user-pwd')}}" method="POST" id="passwordForm">
                        {{csrf_field()}}
                        <input name="current_pwd" id="current_pwd"  type="password" placeholder="Current Password"/>
                        <span id="chkPwd" style="margin-left:10px;"></span>
                        <input name="new_pwd" id="new_pwd"  type="password" placeholder="New Password"/>        
                        <input name="confirm_pwd" id="confirm_pwd"  type="password" placeholder="Confirm New Password"/>
                        <button type="submit" class="btn btn-default  gets">Change Password</button>
                    </form>
                    
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->


@endsection