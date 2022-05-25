<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");

$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new pageController;
$privilege = new privilegeController;
$mat = new materialController;
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
        <!--use just the brands and solid styles-->
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
        <!-- Start Calender  -->
        <link rel="stylesheet" href="/../public/css/calender/fullcalendar.min.css">
        <link rel="stylesheet" href="/../public/css/calender/fullcalendar.print.min.css" media='print'>
        <script src="/../public/js/calender/fullcalendar.min.js"></script>
        <script src="/../public/js/calender/moment.min.js"></script>
        <link rel="stylesheet" href="/../public/css/bucket/clndr.css">
        <link rel="stylesheet" href="/../public/css/bucket/clock/css/style.css">
        <!-- End Calender -->

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

        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
      <!--  <script src="../public/js/evnt.calendar.init.js"></script> -->
        <!--
          <script src="../public/js/skycons.js"></script>
          <script src="../public/js/gauge.js"></script>
        -->
        <!--Easy Pie Chart-->
        <!--<script src="/../public/js/jquery.easypiechart.js"></script>-->
        <!--Sparkline Chart-->
        <!--<script src="../public/js/jquery.sparkline.js"></script>-->

        <!--
        <script src="/../public/js/morris.js"></script>
        <script src="/../public/js/raphael-min.js"></script>
        -->
        <!--jQuery Flot Chart-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.js"></script>-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.tooltip.min.js"></script>-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.resize.js"></script>-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.pie.resize.js"></script>-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.animator.min.js"></script>-->
        <!--<script src="/../public/js/flot-chart/jquery.flot.growraf.js"></script>-->
        <!--
        <script src="../public/ajax/dashboard.js"></script>
        <script src="/../public/js/jquery.customSelect.min.js" ></script>
        <script src="../public/ajax/scripts.js"></script>
        -->
        <style>
            .ScrollStyle{
                height: 290px;
                overflow: auto;
            }
            .ScrollStyle::-webkit-scrollbar {
                width: 10px;
            }

            .ScrollStyle::-webkit-scrollbar-thumb {
                background: #666;
                border-radius: 20px;
            }

            .ScrollStyle::-webkit-scrollbar-track {
                background: #ddd;
                border-radius: 20px;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag">
        <div class="wrapper" >
            <?php
            $obj->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <?php
                $result = $privilege->CustomizePageRelatedView($loguserid, 'dashboard');
                $output = "";
                $output .= '<section class="content">';
                foreach ($result as $row) {
                    if ($row['name'] == 'Dashboard') {
                        $obj->dashboard();
                    } else {
                        $output .= '
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="detailbox info-box bg-aqua" style="cursor: pointer;" id="' . $row['pages'] . '">
                            <span class="info-box-icon"><i class="' . $row['image'] . '"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">' . $row['name'] . '</span>
                            </div>
                        </div>
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
