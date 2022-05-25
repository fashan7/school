<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/../public/img/school.png">
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
  <!-- Start Calender  -->
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.min.css">
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.print.min.css" media='print'>
  <script src="/../public/js/calender/fullcalendar.min.js"></script>
  <script src="/../public/js/calender/moment.min.js"></script>
  <!-- End Calender -->
    
  <!-- Start Latest Links  -->
<!--
  <link rel="stylesheet" href="/../public/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/../public/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/../public/css/daterangepicker.css">
  <link rel="stylesheet" href="/../public/css/all.css">
  <script src="/../public/js/bootstrap-colorpicker.min.js"></script>
  <script src="/../public/js/bootstrap-datepicker.min.js"></script>
  <script src="/../public/js/bootstrap-timepicker.min.js"></script>
  <script src="/../public/js/daterangepicker.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.date.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.numeric.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.phone.extensions.js"></script>
  <script src="/../public/js/masking/jquery.inputmask.regex.extensions.js"></script>
  <script src="/../public/js/icheck.min.js"></script>
-->
  <!-- End Latest Links -->
    
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
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<?php
$page = $_GET['page'];
$result = $obj->CustomizePageRelatedView($loguserid, $page);
$output = "";
$output .= '<section class="content">';
foreach($result as $row)
{
    if($row['name'] == 'Dashboard')
    {
        $objpage->dashboard();
    }
    else
    {        
        $output .= '
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <a class="detailbox info-box " style="cursor: pointer; background-color:#1fb5ad; color:white" href="'.$row['pages'].'">
                            <span class="info-box-icon"><i class="'.$row['image'].'"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">'.$row['name'].'</span>
                            </div>
                        </a>
                    </div>';
    }
}
$output .= '</section>';
echo $output;
?>   
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