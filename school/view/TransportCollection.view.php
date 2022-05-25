<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

$rowmaxreciptId = $mat->getMaxTotalInvoice();
if($rowmaxreciptId == '0')
{
    $reciptId = '0001';
}
else
{
    $incrementorder = intval($rowmaxreciptId) + 1;
    $reciptId = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
}
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
  <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
  <script src="/../public/ajax/header.js"></script>
  <script src="/../public/js/alertify.min.js"></script>
  <script src="/../public/js/jquery-ui.min.js"></script>
  <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
  <script src="/../public/js/jquery.validate.min.js"></script>
  <script src="/../public/js/bootstrap.min.js"></script>
  <script src="/../public/js/admin.min.js"></script>
  <script src="/../public/ajax/StudentFeeCollection.js"></script>
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
  <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<form method="post" id="studenfeesPayment" role="form">
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Fee Collection</h3>
                </div>                
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="UserType">UserType</label>
                                    <select name="usertypeman" id="usertypeman" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Select Type --</option>
                                        <option value="student">Student</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                    <span class="help-block" id="error"></span>                                                
                                </div>
                            </div>
                            <div id="loadAutoCompleteTextBX"></div>  
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <center><b>OR</b></center>
                            </div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="UserType">UserType</label>
                                    <select name="usertype" id="usertype" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Select Type --</option>
                                        <option value="student">Student</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4" id="loadAutocomplete">
                                <div class="form-group">
                                    <label for="User Name">User Name</label>
                                    <input type="text" class="form-control" id="usernamedp" name="usernamedp" placeholder="Search From Student Name" autocomplete="off" readonly>
                                    <span class="help-block" id="error"></span>
                                </div>
                            </div>
                            <div class="col-lg-4" style="padding-top: 24px">
                                <button type="button" class="btn btn-primary" id="Go" name="Go">Go</button> 
                            </div>
                        </div>
                    </div>                
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-lg-2" style="padding-top: 10px">
                            <h3 class="box-title">Payment Window</h3>
                        </div>
                        <div class="col-lg-10" style="text-align: right">
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">                                                                
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <input type="text" class="form-control" id="paydate" name="paydate"  autocomplete="off" value="<?=$date?>" readonly>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#feepay" data-toggle="tab">Fee Payment</a></li>
<!--                                <li><a href="#pdlist" data-toggle="tab">Paid Details</a></li>-->
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="feepay">
                                    <div class="post">
                                        <div class="user-block">
                                            <div class="row">
                                                <div id="paymentFormwithDetails"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="Mode Of Pay">Mode Of Pay</label>
                                                        <select name="modeofpay" id="modeofpay" class="form-control select2" style="width: 100%;">
                                                            <option value="">-- Select Mode --</option>
                                                            <option value="cash">Cash</option>
                                                            <option value="cheque">Cheque</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="ifcheque" style="display:none">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="Bank Name">Bank Name</label>
                                                            <select name="banknameload" id="banknameload" class="form-control select2" style="width: 100%;">
                                                                <option value="">-- Select Bank --</option>
                                                                <?php 
                                                                $result1 = $mat->SelectallBanks();
                                                                foreach($result1 as $row){
                                                                ?>
                                                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                                <?php 
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="Cheque No">Cheque No</label>
                                                            <input type="text" class="form-control" id="chequeno" name="chequeno"  autocomplete="off">
                                                            <span class="help-block" id="error"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="Cheque Date">Cheque Date</label>
                                                            <input type="text" class="form-control" id="chequedate" name="chequedate"  autocomplete="off" readonly>
                                                            <span class="help-block" id="error"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Total Amount">Total Amount</label>
                                                        <input type="text" class="form-control" id="TotalAmount" name="TotalAmount"  autocomplete="off" readonly value="0">
                                                        <span class="help-block" id="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Recipt No">Recipt No</label>
                                                        <input type="text" class="form-control" id="reciptno" name="reciptno"  autocomplete="off" readonly value="<?=$reciptId?>">
                                                        <span class="help-block" id="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Remarks">Remarks</label>
                                                        <textarea class="form-control" id="remarks" name="remarks"  autocomplete="off" rows="3"></textarea>
                                                        <span class="help-block" id="error"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="hiddenbtn" style="display:none">
                                                <div class="col-lg-4">
                                                    <div class="form-group" id="hidebutton">
                                                        <button type="submit" class="btn btn-warning" id="save" name="save">Make Payment</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!--
                                <div class="tab-pane" id="pdlist">
                                    <div class="user-block">
                                        <div class="post">
                                            <div class="user-block">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="loadpaidDetails" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Recipt No</th>
                                                                <th scope="col">Hostel Room</th>
                                                                <th scope="col">Paid Date</th>
                                                                <th scope="col">Amount</th>     
                                                                <th scope="col">Fine</th>     
                                                                <th scope="col">Discount</th>     
                                                                <th scope="col">Remarks</th>   
                                                                <th scope="col">Print</th>     
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>        
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>                        
-->
                            </div>                        
                        </div>                      
                    </div>
                </div>
            </div>            
        </div>            
    </div>
</section>
</form>
</div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<style type="text/css">
.ui-autocomplete.ui-menu
{
    opacity: 0.7;
}
.ui-autocomplete
{
    max-height: 100px;
    overflow-y: auto; /* prevent horizontal scrollbar */
    overflow-x: hidden; /* add padding to account for vertical scrollbar */
    padding-right: 20px;
}
* html .ui-autocomplete
{
    height: 100px;
}
.ui-button
{
    margin-left: -16px;
}
button.ui-button-icon-only
{
    width: 1.2em;
}
.ui-button-icon-only .ui-button-text
{
    padding: 0.35em;
}
.ui-autocomplete-input
{
    margin: 0;padding: 0.48em 0 0.47em 0.45em;
}
</style>
<script>
$(document).ready(function () {    
    $('.select2').select2(); 
    $('#chequedate').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#paydate').datepicker({
        format: 'yyyy-mm-dd'
    });
});
$(document).on('change', '#usertypeman', function(){
    var usertype = $('#usertypeman').val();
    if(usertype != '')
    {
        $.ajax({
            url: "AllocatedUsersforTransport",
            method: "POST",
            data:{usertype:usertype},
            success: function(jsonData)
            {
                $('#loadAutoCompleteTextBX').html(jsonData);
            }
        });
    }
    else
    {
        $('#loadAutoCompleteTextBX').html("");
    }
});
$(document).on('change', '#usertype', function(){
    var usertype = $('#usertype').val();
    if(usertype != '')
    {
        $.ajax({
            url: "AutoCompleteUserType",
            method: "POST",
            data:{usertype:usertype},
            success: function(jsonData)
            {
                $('#loadAutocomplete').html(jsonData);
            }
        });
    }
    else
    {
        $('#loadAutocomplete').html("");
    }
});
</script>
</body>
</html>