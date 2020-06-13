<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin Register</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/backend_css/matrix-login.css')}}" />
        <link href="{{asset('fonts/backend_fonts/css/font-awesome.css" rel="stylesheet')}}" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">   
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
             <form id="loginform" class="form-vertical" method="POST" action="{{ url('/registers') }}">{{ csrf_field() }}
                 <div class="control-group normal_text"> <h3><img src="{{asset('images/backend_images/logo.png')}}" alt="Logo" /></h3></div>
                 <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" name="reg_name" placeholder="Full name" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="email" name="reg_email" placeholder="email" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="reg_password"  />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" value="login" class="btn btn-success" ></span>
                </div>
            </form>
                
        {{-- <script src="{{ asset('js/backend_js/js/jquery.min.js')}}"></script>  
        <script src="{{ asset('js/backend_js/js/matrix.login.js')}}"></script> 
        <script src="{{asset('js/backend_js/bootstrap.min.js')}}"></script>  --}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    </body>

</html>
