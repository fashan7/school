<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
$id = '';
if(isset($_GET['sid']))
{
    if(empty($_GET['sid']))
        return header("location: studentFees");
    
    $id = $_GET['sid'];
}

$studentname = ''; $studentcode = '';
$result = $mat->SelectStudent($id);
foreach($result as $row){
    $studentname = $row['studentname'];
    $studentcode = $row['studentcode'];
}

//$balance = 0;
//$resultFees = $mat->getPaymentBalance($id);
//foreach($resultFees as $rowFess){
//    $balance += $rowFess['balance_amount'];
//}
date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d'); 
$year = date('Y');
$month = date('m');


$rowmaxreciptId = $mat->getMaxStudentInvoice();
if($rowmaxreciptId == '0')
{
    $reciptId = '0001';
}
else
{
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
  <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
  <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="/../public/js/fuelux/js/spinner.js"></script>
  <script src="/../public/ajax/Studentfees.js"></script>
     
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
            <form method="post" id="studentFeesSubmit" role="form" enctype="multipart/form-data" target="upload_frame">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Payment of <?=$studentname?></h3>
                    &nbsp;&nbsp;&nbsp;<small><h6 class="box-title" style="font-size: 13px; ">Recipt No <?=$reciptId?></h6></small>
                </div>
                <div class="box-body">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Student Name">Student Name</label>                            
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-mortar-board"></i>
                                </div>
                                <input type="text" class="form-control" id="studentname" name="studentname" autocomplete="off" value="<?=$studentname?>" readonly>
                            </div>
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Student Code">Student Code</label>                            
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye-slash"></i>
                                </div>
                                <input type="text" class="form-control" id="studentcode" name="studentcode" autocomplete="off" value="<?=$studentcode?>" readonly>
                            </div>
                            <input type="hidden" class="form-control" id="stuid" name="stuid" autocomplete="off" value="<?=$id?>" readonly>
                            <span class="help-block" id="error"></span>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Payment Month">Payment Month</label>
                                <div class="input-group date">
                                    <div class="input-group input-append date dpMonths" data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="<?=$month?>/<?=$year?>">
                                        <div class="input-group-addon add-on">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" readonly class="form-control" name="monthOnly" id="monthOnly">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Payment Date">Payment Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" value="<?=$date?>" readonly>
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Payment Date">Payment for No of Months</label>
                                <div id="spinner4">
                                    <div class="input-group">
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-up btn-primary" onclick="paymentSetup();paymentFinish();">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="spinner-input form-control" maxlength="3" readonly id="noofmonths" name="noofmonths" >
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-down btn-warning" onclick="paymentSetup();paymentFinish();">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Amount Per Month">Amount Per Month</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <input type="text" class="form-control" id="permonthamount" name="permonthamount" autocomplete="off" style="text-align: right" onkeypress="return numOnly(event);" value="0" onchange="paymentSetup();paymentFinish();">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Total Amount to Pay">Total Amount to Pay</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="totalamount" name="totalamount" autocomplete="off" style="text-align: right" onkeypress="return numOnly(event);" readonly value="0">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Total Amount to Pay">Paying Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-ruble"></i>
                                    </div>
                                    <input type="text" class="form-control" id="payingamount" name="payingamount" autocomplete="off" style="text-align: right" onkeypress="return numOnly(event);" onchange="paymentFinish();" value="0">
                                </div>
                                <span class="help-block" id="error"></span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="Balance Amount">Balance Amount</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-bitcoin"></i>
                                    </div>
                                    <input type="text" class="form-control" id="balanceamount" name="balanceamount" autocomplete="off" style="text-align: right" readonly value="0">
<!--                                    <input type="hidden" name="hiddenbalance" id="hiddenbalance" value="">-->
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
                                <button type="submit" class="btn btn-block btn-success btn-flat">Get Slip</button>
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
$(function() {
    $(document).ready(function(){
        loadingScreen(200);
        
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.dpMonths').datepicker();
        $('#spinner4').spinner({value:1, step: 1, min: 1, max: 200});              
    });
    
    function loadingScreen(responseTime) {
        var html = '<div id="load"></div>';
        $('#bodytag').append(html); 
        setTimeout(function() {
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
    
function paymentSetup()
{
    if(document.getElementById("permonthamount").value == '')
        document.getElementById("permonthamount").value = 0;
    
    var noofmonth = parseInt(document.getElementById("noofmonths").value);
    var permonthval = parseFloat(document.getElementById("permonthamount").value);
    document.getElementById("totalamount").value = noofmonth * permonthval;
}

function paymentFinish()
{
    if(document.getElementById("payingamount").value == '')
        document.getElementById("payingamount").value = 0;
    
    var paying = parseFloat(document.getElementById("payingamount").value);
    var topayamount = parseFloat(document.getElementById("totalamount").value);
    
    var x = paying - topayamount;
//    var y = parseFloat(document.getElementById("hiddenbalance").value);
    document.getElementById("balanceamount").value = x;
    
//    var balanceam = parseFloat(document.getElementById("balanceamount").value);
//    if(balanceam <= 0)
//        document.getElementById("balanceamount").value = 0;   
}
</script>
</body>
</html>