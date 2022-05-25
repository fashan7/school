<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$id = '';
if (isset($_GET['stf'])) {
    if (empty($_GET['stf']))
        return header("location: staffSalary");

    $id = $_GET['stf'];
}

$staffname = '';
$staffcode = '';
$result = $mat->SelectStaff($id);
foreach ($result as $row) {
    $staffname = $row['fullname'];
    $staffcode = $row['code'];
}


date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');


$rowmaxreciptId = $mat->getMaxStaffSalaryRecipt();
if ($rowmaxreciptId == '0') {
    $reciptId = '0001';
} else {
    $incrementorder = $rowmaxreciptId + 1;
    $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
}
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
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="/../public/js/fuelux/js/spinner.js"></script>
        <script src="/../public/ajax/StaffSalary.js"></script>

        <style>
            #load {
                position: absolute;
                background: white url('/../public/gif/infinte.gif') no-repeat center center;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag" >
        <div class="wrapper" id="wrap" style="display: none">
<?php
$objpage->header();
?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <form method="post" id="staffSalarySubmit" role="form" enctype="multipart/form-data" target="upload_frame">
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Payment of <?= $staffname ?></h3>
                                        &nbsp;&nbsp;&nbsp;<small><h6 class="box-title" style="font-size: 13px; ">Recipt No <?= $reciptId ?></h6></small>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="Staff Name">Staff Name</label>                            
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-smile-o"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="staffname" name="staffname" autocomplete="off" value="<?= $staffname ?>" readonly>
                                                </div>
                                                <span class="help-block" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="Staff Code">Staff Code</label>                            
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-eye-slash"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="staffcode" name="staffcode" autocomplete="off" value="<?= $staffcode ?>" readonly>
                                                </div>
                                                <input type="hidden" class="form-control" id="staffid" name="staffid" autocomplete="off" value="<?= $id ?>" readonly>
                                                <span class="help-block" id="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Salary Month">Salary Month</label>
                                                    <div class="input-group date" id="hell" >
                                                        <div class="input-group input-append date dpMonths"  data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="<?= $month ?>/<?= $year ?>" >
                                                            <div class="input-group-addon add-on" >
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" readonly class="form-control" name="monthOnly" onchange="dsa()" id="monthOnly" placeholder="Click The Icon">
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="Salary Giving Date">Salary Giving Date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="<?= $date ?>" readonly>
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="Salary Amount (Rs)">Salary Amount (Rs)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-money"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="salaryamount" name="salaryamount" autocomplete="off" style="text-align: right" onkeypress="return numOnly(event);" value="0">
                                                    </div>
                                                    <span class="help-block" id="error"></span>
                                                </div>
                                            </div>
                                        </div>                  
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group" id="hidebutton">
                                                    <button type="submit" class="btn btn-block btn-success btn-flat" id="getrecipt" name="getrecipt">Get Recipt</button>
                                                </div>
                                            </div>
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
            $(function () {
                $(document).ready(function () {
                    loadingScreen(200);

                    $('#datepicker').datepicker({
                        format: 'yyyy-mm-dd'
                    });

                    $('.dpMonths').datepicker({});
                    $('#spinner4').spinner({value: 1, step: 1, min: 1, max: 200});
                });

                function loadingScreen(responseTime) {
                    var html = '<div id="load"></div>';
                    $('#bodytag').append(html);
                    setTimeout(function () {
                        $('#load').remove();
                        document.getElementById("wrap").style.display = "block";
                    }, responseTime);
                }
            });

            function numOnly(e)
            {
                var k;
                document.all ? k = e.keyCode : k = e.which;
                return ((k > 47 && k < 58 || k == 46));
            }
        </script>
    </body>
</html>