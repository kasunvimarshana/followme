<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('node_modules/admin-lte/plugins/iCheck/square/blue.css')); ?>"/>
    <?php echo $__env->make('partials.main_stylesheet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        canvas {
            display: fixed;
            vertical-align: bottom;
        }
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            background: #00356B;
        }
        .login-box {
            /*
            max-width: 90%;
            text-shadow: 0px 0px 2px #131415;
            font-family: 'Open Sans', sans-serif;
            */
            background: rgba(0, 0, 0, 0.4);
            border-radius: 1em;
            width: 45%;
            position: absolute;
            top: 25%;
            right: 50%;
            transform: translate(50%,-50%);
        }
        .login-box-body{
            background-color: transparent;
        }
        .login-logo a, .register-logo a, .login-box-msg{
            color: #F0F0F0;
        }
    </style>
    
    <!-- Scripts -->
    <!-- script src="<?php echo e(asset('js/app.js')); ?>" defer></script -->
    <!-- REQUIRED JS SCRIPTS -->
    <?php echo $__env->make('partials.main_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- REQUIRED JS SCRIPTS -->
</head>
<body class="hold-transition login-page">
    <div id="particles-js"></div>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo e(url('/')); ?>"><b>Follow </b>Me</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo e(url('login')); ?>" method="POST">
      <!-- <?php echo e(csrf_field()); ?> || <?php echo e(Session::token()); ?> -->
      <?php echo csrf_field(); ?>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo e(old('password')); ?>"/>
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

    <!-- a href="<?php echo e(url('/')); ?>">I forgot my password</a><br -->
    <!-- a href="<?php echo e(url('/')); ?>" class="text-center">Register a new membership</a -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- REQUIRED JS SCRIPTS -->
<!-- REQUIRED JS SCRIPTS -->
<!-- iCheck -->
<!-- script src="<?php echo e(asset('node_modules/admin-lte/plugins/iCheck/icheck.min.js')); ?>"></script -->
<!-- script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script -->
<!-- Particle-js -->
<script src="<?php echo e(asset('node_modules/particles.js/particles.js')); ?>"></script>
<script>
// ParticlesJS Config.
particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 700
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 6,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": true,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
}); 
</script>
</body>
</html>
<?php /* C:\Users\kasunv\Desktop\Projects\followme\resources\views/login.blade.php */ ?>