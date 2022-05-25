<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');
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

        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag" onload="startTime()">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Student Attendance</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#dailyAttendance" data-toggle="tab">Daily Attendance</a></li>
                                                <li><a href="#viewattendance" data-toggle="tab">View Attendance</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="dailyAttendance">
                                                    <div class="post">
                                                        <div class="user-block">                                                  
                                                            <div class="box-body">                                                    
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="Date">Date</label>
                                                                        <div class="input-group date">
                                                                            <div class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </div>
                                                                            <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="<?= $date ?>" readonly>
                                                                            <input type="hidden" name="currentdate" id="currentdate" value="<?= $date ?>">
                                                                        </div>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="Grade Number">Grade Number</label>
                                                                        <select class="form-control select2" style="width: 100%;" name="gradenumber" id="gradenumber">
                                                                            <option selected="selected" value=""> -- Grade Number -- </option>
                                                                            <?php
                                                                            $result = $mat->SelectallGradeNumber();
                                                                            foreach ($result as $row) {
                                                                                ?>
                                                                                <option value="<?= $row['id'] ?>"><?= $row['gradenumber'] . " " . $row['gradesection'] ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">
                                                                <div id="getAttendance"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="viewattendance">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <div class="box-body">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="Grade Number">Grade Number</label>
                                                                        <select class="form-control select2" style="width: 100%;" name="gradenumberlist" id="gradenumberlist">
                                                                            <option selected="selected" value=""> -- Grade Number -- </option>
                                                                            <?php
                                                                            $result = $mat->SelectallGradeNumber();
                                                                            foreach ($result as $row) {
                                                                                ?>
                                                                                <option value="<?= $row['id'] ?>"><?= $row['gradenumber'] . " " . $row['gradesection'] ?></option>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <?php
                                                                        $year1 = $year + 1;
                                                                        ?>
                                                                        <label for="Year">Year</label>
                                                                        <select name="year" id="year" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Year --</option>
                                                                            <option value="<?= $year ?>"><?= $year ?></option>
                                                                            <option value="<?= $year1 ?>"><?= $year1 ?></option>
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="Month">Month</label>
                                                                        <select name="month" id="month" class="form-control select2" style="width: 100%;">
                                                                            <option value="">-- Select Month --</option>
                                                                            <option value="01">January</option>
                                                                            <option value="02">February</option>
                                                                            <option value="03">March</option>
                                                                            <option value="04">April</option>
                                                                            <option value="05">May</option>
                                                                            <option value="06">June</option>
                                                                            <option value="07">July</option>
                                                                            <option value="08">August</option>
                                                                            <option value="09">September</option>
                                                                            <option value="10">October</option> 
                                                                            <option value="11">November</option>
                                                                            <option value="12">December</option>  
                                                                        </select>
                                                                        <span class="help-block" id="error"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">
                                                                <div id="loadAttendanceList"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                            
                                            </div>                        
                                        </div>                      
                                    </div>
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
                $('.select2').select2();
                $('#datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                });
                $('#datepicker').datepicker().on('changeDate', function (ev) {
                    var datepicker = $('#datepicker').val();
                    var currentdate = $('#currentdate').val();
                    if (datepicker > currentdate)
                    {
                        $.confirm({
                            icon: 'fa fa-bolt',
                            title: "Warning!",
                            content: "Selected Date Should Lesser or Current Date",
                            type: 'orange',
                            typeAnimated: true
                        });
                    }
                });
            });

            $(document).on('change', '#gradenumber', function () {
                var gradenumber = $('#gradenumber').val();
                var datepicker = $('#datepicker').val();
                $.ajax({
                    url: "AttendanceStudent",
                    method: "POST",
                    data: {gradenumber: gradenumber, datepicker: datepicker},
                    success: function (jsonData)
                    {
                        $("#getAttendance").html(jsonData);
                    }
                });
            });

            $(document).on('change', '#month', function () {
                var gradenumberlist = $('#gradenumberlist').val();
                var year = $('#year').val();
                var month = $('#month').val();
                $.ajax({
                    url: "AttendanceReportStudent",
                    method: "POST",
                    data: {gradenumberlist: gradenumberlist, year: year, month: month},
                    success: function (jsonData)
                    {
                        $('#loadAttendanceList').html(jsonData);
                    }
                });
            });
        </script>
    </body>
</html>