<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        @foreach($assets['backend']['cssFiles'] as $item)
        <link href="{{ asset($item) }}" rel="stylesheet"/>
        @endforeach
        
        <!-- REQUIRED JS SCRIPTS -->
        @foreach($assets['backend']['jsFiles'] as $item)
        <script src="{{ asset($item) }}"></script>
        @endforeach
    </head>
    
    <body class="login-page">
        <div class="login-box">
            
            <div class="login-logo">
                <a href="./"><strong>Admin</strong> Panel</a>
            </div><!-- /.login-logo -->
            
            <div class="login-box-body">
                @if(!Session::has('message-error'))
                <div class="login-box-msg">Sign in to start your session</div>
                @else
                <div class="alert alert-danger"><strong>Oh snap!</strong> {{ Session::get('message-error') }}</div>
                @endif
                <form name="loginForm" id="loginForm" action="{{url('admin/login')}}" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" name="username" id="username" placeholder="Email"/>
                        <i class="fa fa-envelope form-control-feedback"></i>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password"/>
                        <i class="fa fa-key form-control-feedback"></i>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember_me" value="1"> Remember Me
                                </label>
                            </div>   
                        </div>
                        <div class="col-xs-5">
                            <button type="submit" class="btn btn-success btn-block btn-flat"><i class="fa fa-sign-in"> </i> Sign In</button>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>
                <!--a href="#">I forgot my password</a><br-->
                <!--a href="register.html" class="text-center">Register a new membership</a-->
                
            </div>
        </div>
        
        
        
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_minimal-green',
                    radioClass: 'iradio_minimal-green',
                });
            });
        </script>
        
    </body>
</html>