<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/font-awesome/css/font-awesome.min.css') }}"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/Ionicons/css/ionicons.min.css') }}"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/plugins/iCheck/square/blue.css') }}"/>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/dist/css/AdminLTE.min.css') }}"/>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/dist/css/skins/_all-skins.min.css') }}"/>
    <!-- link href="{{ asset('css/app.css') }}" rel="stylesheet"/ -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"/>
    <!-- Scripts -->
    <!-- script src="{{ asset('js/app.js') }}" defer></script -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('node_modules/admin-lte/dist/js/adminlte.min.js') }}"></script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><b>Follow </b>Me</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ url('/') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div -->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- social-auth-links -->
    <!-- div class="social-auth-links text-center">
    </div -->
    <!-- /.social-auth-links -->

    <!-- a href="{{ url('/') }}">I forgot my password</a><br -->
    <!-- a href="{{ url('/') }}" class="text-center">Register a new membership</a -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- REQUIRED JS SCRIPTS -->
<!-- REQUIRED JS SCRIPTS -->
<!-- iCheck -->
<!-- script src="{{ asset('node_modules/admin-lte/plugins/iCheck/icheck.min.js') }}"></script -->
<!-- script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script -->
</body>
</html>
