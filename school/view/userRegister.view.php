<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new materialController;
$objpage = new pageController;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
  <link rel="shortcut icon" href="/../public/img/school.png">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="/../public/ajax/logout.js"></script>
  <script src="/../public/js/jquery.min.js"></script>
  <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">
  <script src="/../public/js/jquery-confirm.min.js"></script>
  <link rel="stylesheet" href="/../public/css/admin.css">
  <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
  <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
  <link rel="stylesheet" href="/../public/css/alertify.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
<!--  <script src="/../public/ajax/header.js"></script>-->
  <script src="/../public/js/alertify.min.js"></script>
  <script src="/../public/js/jquery-ui.min.js"></script>
  <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
  <script src="/../public/js/jquery.validate.min.js"></script>
  <script src="/../public/js/bootstrap.min.js"></script>
  <script src="/../public/js/admin.min.js"></script>
  <script src="/../public/js/jquery.mask.js"></script>
  <script src="/../public/ajax/userreg.js"></script>
  <style>
    .solo-wrapper{
      border: 1px solid #ccc;
      padding: 10px;
      display: inline-block;
    }
    input.solo {border:none; outline: 0;}

    /* FOR SEPERATE INPUTS */
    .date-input-container {
      border: 1px solid #ccc;
      display: inline-block;
      padding: 3px;
    }
    .date-input-container input {
      border: 0;
      outline: 0;
      text-align: center;
      width: 25px;
    }
    .date-input-container input.day, .date-input-container input.month {
      margin-right: 0px;
    }
    .date-input-container input.year {
      width: 30px;
    }
  </style>  
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
            <h3 class="box-title">User Registeration</h3>
        </div>
        <div class="box-body">
            <form method="post" id="userregsubmit" role="form" enctype="multipart/form-data" target="upload_frame">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="First Name">First Name</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Last Name">Last Name</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fab fa-linode"></i>
                            </div>
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Mobile No">Mobile No</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="N I C">N I C</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-tag"></i>
                            </div>
                            <input type="text" class="form-control" id="nic" name="nic" placeholder="N I C">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Email Address">Email Address</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Address">Address</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" >
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="UserName">UserName</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <input type="text" class="form-control" id="username" name="username" placeholder="UserName">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="Password">Password</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user-secret"></i>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <span class="help-block" id="error"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="UserType">UserType</label>                  
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fas fa-user"></i>
                            </div>
                            <select class="form-control select2" style="width: 100%;" name="usertype" id="usertype">
                              <option selected="selected" value=""> -- UserName -- </option>
                              <?php
                          $result = $obj->usertypeSelect();
                          foreach($result as $rows){
                              ?>
                              <option value="<?=$rows['id']?>"><?=$rows['name']?></option>
                              <?php                              
                          }
                          ?>
                        </select>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="Date Of Birth">Date Of Birth</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-birthday-cake"></i>
                        </div>
                        <div class="form-control date-input-container">
                          <input type="text" id="day" name="day" maxlength="2" placeholder="DD" class="day" />
                          <span class="separator">/</span>
                          <input type="text" name="month" id="month" maxlength="2" placeholder="MM" class="month" />
                          <span class="separator">/</span>
                          <input type="text" name="year" id="year" maxlength="4" placeholder="YYYY"class="year" />
                        </div>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
            <div class="col-lg-3">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="help-block" id="error"></span>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="UserType">UserType</label>                  
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-code-branch"></i>
                        </div>
                        <select class="form-control select2" style="width: 100%;" name="branchname" id="branchname">
                          <option selected="selected" value=""> -- Branch -- </option>
                            <?php
                        $result12 = $obj->branchSelect();
                        foreach($result12 as $rows){
                              ?>
                              <option value="<?=$rows['id']?>"><?=$rows['name']?></option>
                              <?php                              
                          }
                          ?>
                        </select>
                    </div>
                    <span class="help-block" id="error"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group" id="hidebutton">
                    <button type="submit" class="btn btn-block btn-warning btn-flat" name="save" id="save"><i>Save</i></button>
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
<script>
$(document).ready(function (){
    var soloInput = $('input.solo');

soloInput.on('keyup', function(){
  var v = $(this).val();
  if (v.match(/^\d{2}$/) !== null) {
    $(this).val(v + '/');
  } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
    $(this).val(v + '/');
  }  
});


function moveToNext(selector, nextSelector) {
  $(selector).on('input', function () {    
    if (this.value.length >= 2) {
      // Date has been entered, move
      $(nextSelector).focus();
    }
  });
}


$(function () {
  moveToNext('.day', '.month');
  moveToNext('.month', '.year');
});
});
</script>
</body>
</html>