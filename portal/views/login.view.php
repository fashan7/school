<?php
//session_start();
if(isset($_COOKIE['username']))
{
    if(isset($_SESSION['logusersid']))
    {
        return header("location: /");
    }
    else
    {
        return header("location: lockscreen");
    }
}    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Login</title>

    <!--Core CSS -->
    <link href="/../public/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/../public/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/../public/css/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/../public/css/style.css" rel="stylesheet">
    <link href="/../public/css/style-responsive.css" rel="stylesheet" />
    
    
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/../public/js/jquery.particles.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="/../public/ajax/login.js"></script>
    <link rel="shortcut icon" href="../public/media/fashan/logo.png" />
    <style>
      .background
        {
          background-image: url('../public/img/balllogin.jpg');
          background-size: cover;
          background-position: center bottom;
          background-repeat: no-repeat;
          background-attachment: fixed;
          display: block;
          max-width: 100%;
          height: auto;
        }
  </style>
</head>

  <body class="hold-transition login-page background">
      <canvas class="canvas" style="position: fixed; z-index: -9999"></canvas>
    <div class="container" id="toggle">

      <form class="form-signin" method="post" id="loginForm">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <input type="text" class="form-control" placeholder="User ID" autofocus name="username" id="username" autocomplete="off">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <div id="hidebutton">
                <button class="btn btn-lg btn-login btn-block" type="submit" name="login" id="login">Sign in</button>
            </div>
            <center>
                <div id="showloading"></div>
            </center>
        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->
      </form>
    </div>
    <!--Core js-->
    <script src="/../public/js/bootstrap/bootstrap.min.js"></script>
    <script>
    $( document ).ready(function() {
      $( "#toggle" ).effect( "shake" );
    });
    $(document).ready(function() {
        $('.canvas').particles({
          connectParticles: true,
          color: '#ffffff',
          size: 3,
          maxParticles: 40,
          speed: 1.0
        });
    });
    </script>
  </body>
</html>
