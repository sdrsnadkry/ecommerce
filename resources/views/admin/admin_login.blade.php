<!DOCTYPE html>
<html lang="en">

<head>
    <title>Matrix Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/matrix-login.css')}}" />
    <link href="{{ asset('fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
<style type="text/css">
    body {
        background: url('../images/backend_images/bg.jpg') no-repeat center center fixed !important;
        -webkit-background-size: cover !important;
        -moz-background-size: cover !important;
        -o-background-size: cover !important;
        background-size: cover !important;
    }

    .username {
        height: 42px !important;
        padding-left: 10px !important;
        /*background: none!important;*/
    }

    .main_input_box .add-on i {
        font-size: 25px !important;
    }

    .password {
        height: 35px !important;
    }

    .headings {
        color: white;
        font-weight: 1000px;
        position: relative;
        animation: text 2s 1;
        border-bottom: 5px solid #4caf50;

    }

    @keyframes text {
        0% {
            color: black;
        }

        30% {
            color: green;
            letter-spacing: 8px;
        }

        85% {
            letter-spacing: 0px;

        }

    }
</style>

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
        <form id="loginform" class="form-vertical" method="POST" action="{{ url('admin') }}">{{ csrf_field() }}
            <div class="normal_text ">
                <h3 class="headings">ADMIN LOGIN</h3>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lb"><i class="icon-user"> </i></span><input class="username" type="username" name="username" placeholder="Username" />
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <div class="main_input_box">
                        <span class="add-on bg_lr"><i class="icon-lock"></i></span><input class="password" type="password" placeholder="Password" name="password" />
                    </div>
                </div>
            </div>
            <div class="form-actions">

                <span class=""><input type="submit" value="login" class="btn btn-block btn-success" style="border-radius: 10px"></span>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>