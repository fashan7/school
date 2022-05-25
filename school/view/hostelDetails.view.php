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
  <link rel="stylesheet" href="/../public/css/select2.min.css">
  <script src="/../public/js/select2.min.js"></script>
  <script src="/../public/ajax/hosteltype.js"></script>
  <script src="/../public/ajax/hostel.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <link href="/../public/css/tableresponsive.css" rel="stylesheet"/>
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
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
                    <h3 class="box-title">Hostel Related</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#addhostel" data-toggle="tab">Add Hostel Type</a></li>
                                <li><a href="#addhosteldet" data-toggle="tab">Add Hostel Details</a></li>
                            </ul>
                                <div class="tab-content">
                                    <div class="active tab-pane" id="addhostel">
                                        <div class="post">                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div id="popupUpdate">
                                                        <form method="post" id="hosteltypeReg" role="form">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Hostel Type">Hostel Type</label>
                                                                    <input type="text" class="form-control" id="hosteltype" name="hosteltype" placeholder="Enter Hostel Type" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group" id="hidebutton">                                             
                                                                    <button type="submit" class="btn btn-warning" id="save" name="save">Save</button>   
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" id="getAllHostelTypes" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Hostel Type</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="addhosteldet">
                                        <div class="user-block">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div id="LoadtoUpdateHostel">
                                                        <form method="post" id="hostelReg" role="form">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Hostel Type">Hostel Type</label>
                                                                    <select name="hosteltype" id="hosteltype" class="form-control select2" style="width: 100%;">
                                                                        <option value="">-- Select Hostel Type --</option>
                                                                        <?php 
                                                                        $result1 = $mat->hostelsType();
                                                                        foreach($result1 as $row){
                                                                        ?>
                                                                            <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                                                        <?php 
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Hostel Name">Hostel Name</label>
                                                                    <input type="text" class="form-control" id="hostelname" name="hostelname" placeholder="Enter Hostel Name" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Hostel Address">Hostel Address</label>
                                                                    <textarea type="text" class="form-control" id="hosteladdr" name="hosteladdr" placeholder="Enter Hostel Address" autocomplete="off" rows="3"></textarea>
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Hostel Phone Number">Hostel Phone Number</label>
                                                                    <input type="text" class="form-control" id="hostelpno" name="hostelpno" placeholder="Enter Hostel Phone Number" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Warden Name">Warden Name</label>
                                                                    <input type="text" class="form-control" id="wardenname" name="wardenname" placeholder="Enter Warden Name" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Warden Address">Warden Address</label>
                                                                    <textarea type="text" class="form-control" id="wardenaddr" name="wardenaddr" placeholder="Enter Warden Address" autocomplete="off" rows="3"></textarea>
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Warden Phone Number">Warden Phone Number</label>
                                                                    <input type="text" class="form-control" id="wardenpno" name="wardenpno" placeholder="Enter Warden Phone Number" autocomplete="off">
                                                                    <span class="help-block" id="error"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group" id="hidebuttonsave">                                             
                                                                    <button type="submit" class="btn btn-warning" id="save" name="save">Save</button> 
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped" id="getAllHostels" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Hostel Name</th>
                                                                    <th scope="col">Hostel Type</th>
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
$(document).ready(function(){
    $('.select2').select2();  
    
    var dataTable = $('#getAllHostelTypes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getHotelTypes",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [0, 2],
                "orderable": false
            },
        ],
    });
    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "hostelTypedelete",
            method:"POST",
            data:{id:id},
            success:function()
            {
                dataTable.ajax.reload();
            }
        });
    });
    var dataTable = $('#getAllHostels').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax" :{
            url: "getHostels",
            method: "POST"
        },
        "columnDefs":[
            {
                "targets": [0, 3, 2],
                "orderable": false
            },
        ],
    });
    $(document).on('click', '.deletex', function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "hostelsdelete",
            method:"POST",
            data:{id:id},
            success:function()
            {
                dataTable.ajax.reload();
            }
        });
    });
});
$(document).on('click', '.edit', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "hostelTypeUpdate",
        method:"POST",
        data:{id:id},
        success:function(jsonData)
        {
            $('#popupUpdate').html("");
            $('#popupUpdate').html(jsonData);
        }
    });
});
$(document).on('click', '.editx', function(){
    var id = $(this).attr('id');
    $.ajax({
        url: "UpdateHostelDetails",
        method:"POST",
        data:{id:id},
        success:function(jsonData)
        {
            $('#LoadtoUpdateHostel').html("");
            $('#LoadtoUpdateHostel').html(jsonData);
        }
    });
});



</script>
</body>
</html>