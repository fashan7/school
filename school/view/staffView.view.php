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
  <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Start Calender  -->
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.min.css">
  <link rel="stylesheet" href="/../public/css/calender/fullcalendar.print.min.css" media='print'>
  <script src="/../public/js/calender/fullcalendar.min.js"></script>
  <script src="/../public/js/calender/moment.min.js"></script>
  <!-- End Calender -->
    <link rel="shortcut icon" href="/../public/img/school.png">
  <!-- Start Latest Links  -->
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="/../public/js/typeahead.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <style>

        .tt-menu { width:300px; }
        ul.typeahead{margin:0px;padding:10px 0px;}
        ul.typeahead.dropdown-menu li a {padding: 10px !important;	border-bottom:#CCC 1px solid;color:#FFF;}
        ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important; }
        .bgcolor {max-width: 550px;min-width: 290px;max-height:340px;background:url("world-contries.jpg") no-repeat center center;padding: 100px 10px 130px;border-radius:4px;text-align:center;margin:10px;}
        .demo-label {font-size:1.5em;color: #686868;font-weight: 500;color:#FFF;}
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
            text-decoration: none;
            background-color: #1f3f41;
            outline: 0;
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
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Search Staff</h3>
                </div>
                <div class="box-body">
                  <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-search"></i>
                    </div>
                    <input class="typeahead form-control input-md"  type="text" name="searchstafftext" id="searchstafftext" placeholder="Type Name Or  Code of the Staff">
                </div>

                </div>            
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Staff Details</h3>
                </div>
                <div class="box-body">      
                    <div id="staffdata"></div>
                </div>            
            </div>
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
    $(document).ready(function () {
        load_data('');
        function load_data(query, typeahead_search = "yes")
        {
            $.ajax({
                url: "searchStaff",
                method: "POST",
                data: {query: query, typeahead_search: typeahead_search},
                success: function(data)
                {
                    $('#staffdata').html(data)
                }
            });
        }
        $('#searchstafftext').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "searchStaff",
                    method: "POST",
                    data: {query: query},
                    dataType: "json",
                    success: function (data) 
                    {
                        result($.map(data, function (item) 
                        {
                            return item;
                        }));
                        load_data(query, 'yes');
                    }
                });
            }
        });
    });
</script>
</body>
</html>