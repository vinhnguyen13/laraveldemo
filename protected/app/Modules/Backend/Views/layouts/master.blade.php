<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="@yield('meta_description')">
        <meta name="keywords" content="@yield('meta_keywords')">
        
        @foreach($assets['backend']['cssFiles'] as $item)
        <link href="{{ asset($item) }}" rel="stylesheet"/>
        @endforeach
        
        
        <!-- REQUIRED JS SCRIPTS -->
        @foreach($assets['backend']['jsFiles'] as $item)
        <script src="{{ asset($item) }}"></script>
        @endforeach
       
       
        
    </head>
    
    <body class="skin-{{ $assets['backend']['layout']['skin-color'] }} fixed sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{url('admin')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>dmin</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b> Panel</span>
                </a>
                
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            
                            
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <!--img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/-->
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><i class="fa fa-user"></i> {{Auth::admin()->get()->first_name . ' ' . Auth::admin()->get()->surname}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <!--img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" /-->
                                        <p>
                                            {{Auth::admin()->get()->first_name . ' ' . Auth::admin()->get()->surname}} - {{Auth::admin()->get()->title}}
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    
                                    <!--li class="user-body">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                    </li-->
                                    
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-info btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{url('admin/logout')}}" class="btn btn-warning btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                                
                            </li><!-- ./User Account Menu -->
                            
                            <!-- Control Sidebar Toggle Button -->
                            <!--li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li-->
                            
                        </ul>
                        
                    </div><!-- ./Navbar Right Menu -->
                    
                </nav><!-- ./Header Navbar -->
                
            </header>
            
            @include('Backend::layouts.sidebar')
            
            <div class="content-wrapper">
                
                @yield('content')
                
            </div>
            
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    <br/><br/>
                    Powered by <a href="http://laravel.com/" target="_blank">Laravel Framework</a>
                </div>
                <!-- Default to the left -->
                Developed by <a href="mailto:minh_dat_le@yahoo.com" target="_blank">Dat Le</a><br/> 
                <strong>e.</strong> <a href="mailto:minh_dat_le@yahoo.com" target="_blank">minh_dat_le@yahoo.com</a> | 
                <strong>m.</strong> (+84) 919 564 515<br/>
                Copyright &copy; 2014 - <?php echo date('Y'); ?>. All Rights Reserved.<br/>
            </footer>
            
        </div><!--./Wrapper -->
                
        
        
    </body>
</html>