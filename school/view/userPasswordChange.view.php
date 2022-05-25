<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$objpage = new pageController;
$obj = new materialController;
$row = $obj->userregDetails($loguserid);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <link rel="shortcut icon" href="/../public/img/school.png">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="/../public/ajax/logout.js"></script>
  <script src="/../public/js/jquery.min.js"></script>
  <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">
  <script src="/../public/js/jquery-confirm.min.js"></script>
  <link rel="stylesheet" href="/../public/css/admin.css">
  <link rel="stylesheet" href="/../public/css/flipclock.css">
  <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
  <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
  <link rel="stylesheet" href="/../public/css/alertify.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <script src="/../public/ajax/header.js"></script>
  <script src="/../public/js/alertify.min.js"></script>
  <script src="/../public/js/jquery-ui.min.js"></script>
  <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
  <script src="/../public/js/jquery.validate.min.js"></script>
  <script src="/../public/js/bootstrap.min.js"></script>
  <script src="/../public/js/admin.min.js"></script>
  <script src="/../public/js/flipclock.min.js"></script>
  <script src="/../public/js/jquery.mask.js"></script>
  <script src="/../public/ajax/passwordChange.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">User Password Updation</h3>
        </div>
        <div class="box-body">
            <form method="post" id="passwordChangeSubmit" role="form" enctype="multipart/form-data" target="upload_frame">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="UserName">UserName</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="UserName" value="<?=$row['username']?>" readonly>
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Password">Current Password</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user-secret"></i>
                            </div>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Current Password">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Password">New Password</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                            <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Password">Confirm Password</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-check-square"></i>
                            </div>
                            <input type="password" class="form-control" id="conpassword" name="conpassword" placeholder="Confirm Password">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group" id="hidebutton">
                    <button type="submit" class="btn btn-block btn-warning btn-flat" name="update" id="update"><i>Update</i></button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
</section>
</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
</body>
</html>