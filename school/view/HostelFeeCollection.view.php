<?php
session_start();
if(!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

$rowmaxreciptId = $mat->getMaxHostelInvoice();
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
  <script src="/../public/ajax/HostelFeeCollection.js"></script>
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
<form method="post" id="HostelFeesPayment" role="form">
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
                        <div class="row">
                            <div class="col-lg-12" id="getUserRoomsDetails"></div>
                        </div>
                    </div>                
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Fees Payment</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#feepay" data-toggle="tab">Fee Payment</a></li>
                                <li><a href="#pdlist" data-toggle="tab">Paid List</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="active tab-pane" id="feepay">
                                    <div class="post">
                                        <div class="user-block">
                                            <div class="row" id="AutoloadFees">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="UserType">FeeType</label>
                                                        <select  name="feetype" id="feetype" class="form-control select2" style="width: 100%;" multiple="multiple">
                                                            <option value="" disabled="disabled">-- Select Type --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Amount">Amount</label>
                                                        <input type="text" class="form-control" id="dupamount" name="dupamount" placeholder="Amount Will AutoLoad" autocomplete="off">
                                                        <span class="help-block" id="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Fine">Fine</label>
                                                        <input type="text" class="form-control" id="fine" name="fine"  autocomplete="off" onchange="Totalcal();" value="0">
                                                        <span class="help-block" id="error"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="Discount">Discount</label>
                                                        <input type="text" class="form-control" id="discount" name="discount"  autocomplete="off" onchange="Totalcal();" value="0">
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
                                                        <label for="Paying Amount">Paying Amount</label>
                                                        <input type="text" class="form-control" id="payingamount" name="payingamount"  autocomplete="off" readonly value="0">
                                                        <input type="hidden" name="totalAmount" id="totalAmount" value="0">
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
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group" id="hidebutton">
                                                        <button type="submit" class="btn btn-warning" id="save" name="save">Make Payment</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    
    var dataTable = $('#loadpaidDetails').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getAllPaidFees",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [0,1,2,3,4,5,6,7],
                "orderable": false
            },
        ],
    });
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
$(document).on('click', '#Go', function(){
    var usertype = $('#usertype').val();
    if(usertype == 'student') 
    {
        var userid = $('#studentid').val(); 
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "SmallMemberDetails",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success: function(jsonData){
                    $('#getUserRoomsDetails').html(jsonData);
                }
            });
        }
    }
    else if(usertype == 'employee')
    {
        var userid = $('#staffid').val();
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "SmallMemberDetails",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success: function(jsonData){
                    $('#getUserRoomsDetails').html(jsonData);
                }
            });
        }
    }
});
$(document).on('click', '#Go', function(){
    var usertype = $('#usertype').val();
    if(usertype == 'student') 
    {
        var userid = $('#studentid').val(); 
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "GetFeesHostel",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success:function(jsonData)
                {
                    $('#AutoloadFees').html(jsonData);
                }
            });
        }
    }
    else if(usertype == 'employee')
    {
        var userid = $('#staffid').val();
        if(usertype != '' && userid != '')
        {
            $.ajax({
                url: "GetFeesHostel",
                method: "POST",
                data:{usertype:usertype, userid:userid},
                success:function(jsonData)
                {
                    $('#AutoloadFees').html(jsonData);
                }
            });
        }
    }    
});
$(document).on('change', '#modeofpay', function(){
    var modeofpay = $('#modeofpay').val();
    if(modeofpay == 'cheque')
    {
        document.getElementById("ifcheque").style.display="block";
    }
    else
    {
        document.getElementById("ifcheque").style.display="none";
    }
});


function FeesCal()
{
    var countSelected = $("#feetypes :selected").length;
    var amount = $('#amount').val(); 
    if($('#amount').val() == "")
    {
        $('#amount').val(ReplaceAmount);
    }
    
    var total = parseInt(countSelected) * parseFloat(amount);
    $('#payingamount').val(total);
    $('#totalAmount').val(total);
}
    
function fineCal()
{
    var fine = $('#fine').val(); var payingamount = $('#payingamount').val();
    var total = parseFloat(payingamount) + parseFloat(fine);
    $('#payingamount').val(total);
}
    
function DiscountCal()
{
    var discount = $('#discount').val(); var payingamount = $('#payingamount').val();
    var total = parseFloat(payingamount) - parseFloat(discount);
    $('#payingamount').val(total);
}
    
function Totalcal()
{
    var ReplaceAmount = $('#singleAmount').val();
    if($('#amount').val() == "")
    {
        $('#amount').val(ReplaceAmount);
    }
    if($('#fine').val() == '')
    {
        $('#fine').val(0);
    }
    if($('#discount').val() == '')
    {
        $('#discount').val(0);
    }
    var payingamount = $('#payingamount').val(); var fine = $('#fine').val(); var discount = $('#discount').val(); var totalAmount = $('#totalAmount').val();
    
    var sum = parseFloat(totalAmount) + parseFloat(fine) - parseFloat(discount);
    $('#payingamount').val(sum);
}
</script>
</body>
</html>