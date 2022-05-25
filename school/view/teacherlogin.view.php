<?php
session_start();
if(isset($_SESSION['loguserid']))
    return header("location: /");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Demo | Teacher Portal | Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/../public/img/school.png">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="/../public/css/login.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <link rel="stylesheet" href="/../public/fonts/font-awesome-animation.min.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="/../public/ajax/teacherlogin.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  <script src="/../public/js/jquery.particles.js"></script>
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
<body class="hold-transition login-page background" >
<canvas class="canvas" style="position: fixed; z-index: -9999"></canvas>
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Demo</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" id="toggle">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="checkLogin" method="post" id="loginForm">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" autocomplete="off">
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
<!--            <input type="submit"/>-->
          <div id="hidebutton">        
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" id="login">Sign In</button>
          </div>
          <div id="showloading"></div>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>

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
