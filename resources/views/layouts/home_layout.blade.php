<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    @section("section_stylesheet")
    <!-- Bootstrap --> 
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css') }}"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css') }}"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/dist/css/AdminLTE.min.css') }}"/>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/dist/css/skins/_all-skins.min.css') }}"/>
    <!-- Styles -->
    <!-- link href="{{ URL::asset('css/app.css') }}" rel="stylesheet"/ -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"/>
    @show
    @section("section_script_main")
    <!-- Scripts -->
    <!-- script src="{{ URL::asset('js/app.js') }}" defer></script -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('node_modules/admin-lte/dist/js/adminlte.min.js') }}"></script>
    @show
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-default sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  @section("main_header")
    <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>ME</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Follow </b>ME</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
          <!-- /.notifications-menu -->
            
          <!-- Tasks Menu -->
          <!-- /.tasks-menu -->
            
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ URL::asset('node_modules/admin-lte/dist/img/avatar5.png') }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ URL::asset('node_modules/admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              @section('menu_body')
              <!-- Menu Body -->
              <!-- li class="user-body">
              </li -->
              <!-- ./menu-body -->
              @show
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li -->
          <!-- ./control-sidebar-toggle-button -->
        </ul>
      </div>
    </nav>
    </header>
  @show
  <!-- ./main-header -->
    
  <!-- Left side column. contains the logo and sidebar -->
    @section("left_side_column")
    <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ URL::asset('node_modules/admin-lte/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">ACTIVITIES</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-edit"></i> <span>MEETING</span></a></li>
        <li><a href="#"><i class="fa fa-edit"></i> <span>3W</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    </aside>
    @show
  <!-- ./left-side-column. contains the logo and sidebar -->

  @section('content_wrapper')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @section('content_header')
    @show
    <!-- ./Content Header (Page header) -->
    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('content')
        <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @show

  <!-- Main Footer -->
  @section('main_footer')
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
        Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>
  @show
  <!-- ./main-footer -->

  <!-- Control Sidebar -->
  @section('control_sidebar')
  <!-- aside class="control-sidebar control-sidebar-dark">
  </aside -->
  @show
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
@section('section_script')
@show
<!-- REQUIRED JS SCRIPTS -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>