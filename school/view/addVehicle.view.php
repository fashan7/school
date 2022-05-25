<?php
session_start();
if(!isset($_SESSION['loguserid']))
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
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <script src="/../public/ajax/VehicleReg.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini" id="bodytag" onload="startTime()">
<div class="wrapper" >
<?php 
$objpage->header();
?>
<div class="content-wrapper" id="loadAllDetails">    
<section class="content">
    <div class="row">        
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Vehicle Details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10" id="updateVehicle">
                            <form method="post" id="VehicleReg" role="form">
                                <div class="form-group">
                                    <label for="Vehicle No">Vehicle No</label>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" id="vehicleno1" name="vehicleno1" placeholder="CAE" autocomplete="off" maxlength="3">
                                            <span class="help-block" id="error"></span>
                                        </div>
                                        <div class="col-lg-1">_</div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="vehicleno2" name="vehicleno2" placeholder="1111" autocomplete="off" maxlength="4">
                                            <span class="help-block" id="error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="No Of Seats">No Of Seats</label>
                                    <input type="text" class="form-control" id="noofseats" name="noofseats" placeholder="Enter No Of Seats" autocomplete="off">
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Maximum Allowed">Maximum Allowed</label>
                                    <input type="text" class="form-control" id="maximumallowed" name="maximumallowed" placeholder="Enter Maximum Allowed" autocomplete="off">
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Vehicle Type">Vehicle Type</label>
                                    <select name="vehicletype" id="vehicletype" class="form-control select2" style="width: 100%;">
                                        <option value="">-- Please Select --</option>
                                        <option value="Contract">Contract</option>
                                        <option value="Ownership">Ownership</option>
                                    </select>
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Contact Person">Contact Person</label>
                                    <input type="text" class="form-control" id="contactperson" name="contactperson" placeholder="Contact Person" autocomplete="off">
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Insurance Renewal Date">Insurance Renewal Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="insurancerenewal" name="insurancerenewal" value="<?=$date?>" readonly>
                                    </div>
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Track ID">Track ID</label>
                                    <input type="text" class="form-control" id="trackid" name="trackid" autocomplete="off">
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group" id="hidebutton">
                                    <button type="submit" class="btn btn-warning" id="save" name="save">Save</button>   
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="loadvehicles">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Vehicle No</th>
                                            <th scope="col">No Of Seats</th>
                                            <th scope="col">Max Allowed</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Action</th>
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
    $('#insurancerenewal').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('.select2').select2();

    var dataTable = $('#loadvehicles').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getAllVehicles",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [5],
                "orderable": false
            },
        ],
    });
});
$(document).on('click', '.delete', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "deleteVehicles",
        method:"POST",
        data:{id:id},
        success:function()
        {
            setTimeout("location.href = 'addVehicle';",0);
        }
    });
});
$(document).on('click', '.edit', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "UpdateAddVehicle",
        method:"POST",
        data:{id:id},
        success:function(jsonData)
        {
            $('#updateVehicle').html("");
            $('#updateVehicle').html(jsonData);
        }
    });
});

</script>
</body>
</html>